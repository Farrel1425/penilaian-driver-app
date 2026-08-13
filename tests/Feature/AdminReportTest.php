<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\Driver;
use App\Models\Question;
use App\Models\Rating;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_and_reports_render_empty_data(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('admin.dashboard'))->assertOk()->assertSee('Total Penilaian')->assertSee('Belum ada');
        $this->get(route('admin.monitoring.index'))->assertOk()->assertSee('Belum ada penilaian');
        $this->get(route('admin.reports.drivers'))->assertOk()->assertSee('Report Driver');
        $this->get(route('admin.reports.vehicles'))->assertOk()->assertSee('Report Kendaraan');
    }

    public function test_report_average_uses_only_rating_answers_not_yes_no(): void
    {
        $this->actingAs(User::factory()->create());
        [$branch, $driver, $vehicle] = $this->makeEntities();
        $driverQuestion = Question::factory()->create(['target_type' => Question::TARGET_DRIVER, 'answer_type' => Question::TYPE_RATING]);
        $yesNoQuestion = Question::factory()->create(['target_type' => Question::TARGET_DRIVER, 'answer_type' => Question::TYPE_YES_NO]);
        $rating = Rating::factory()->for($branch)->for($driver)->for($vehicle)->create(['submitted_at' => '2026-08-10 10:00:00']);
        $rating->answers()->create(['question_id' => $driverQuestion->id, 'answer_value' => [5]]);
        $rating->answers()->create(['question_id' => $yesNoQuestion->id, 'answer_value' => [0]]);

        $this->get(route('admin.reports.drivers'))
            ->assertOk()
            ->assertSee('Average Rating')
            ->assertSee('5')
            ->assertDontSee('2.5');
    }

    public function test_branch_filter_limits_dashboard_data(): void
    {
        $this->actingAs(User::factory()->create());
        [$branchA, $driverA, $vehicleA] = $this->makeEntities();
        [$branchB, $driverB, $vehicleB] = $this->makeEntities();
        $question = Question::factory()->create(['target_type' => Question::TARGET_DRIVER, 'answer_type' => Question::TYPE_RATING]);
        $this->makeRating($branchA, $driverA, $vehicleA, $question, 5);
        $this->makeRating($branchB, $driverB, $vehicleB, $question, 1);

        $this->get(route('admin.dashboard', ['branch_id' => $branchA->id]))
            ->assertOk()
            ->assertSee('1 penilaian')
            ->assertSee('Avg 5')
            ->assertDontSee('Avg 1');
    }

    public function test_date_range_filter_limits_monitoring_data(): void
    {
        $this->actingAs(User::factory()->create());
        [$branch, $driver, $vehicle] = $this->makeEntities();
        $question = Question::factory()->create(['target_type' => Question::TARGET_DRIVER, 'answer_type' => Question::TYPE_RATING]);
        $old = $this->makeRating($branch, $driver, $vehicle, $question, 2, '2026-08-01 10:00:00');
        $new = $this->makeRating($branch, $driver, $vehicle, $question, 4, '2026-08-12 10:00:00');

        $this->get(route('admin.monitoring.index', ['start_date' => '2026-08-10', 'end_date' => '2026-08-13']))
            ->assertOk()
            ->assertSee($new->submitted_at->format('d M Y'))
            ->assertDontSee($old->submitted_at->format('d M Y'));
    }

    public function test_driver_and_vehicle_report_accuracy(): void
    {
        $this->actingAs(User::factory()->create());
        [$branch, $driver, $vehicle] = $this->makeEntities();
        $driverQuestion = Question::factory()->create(['target_type' => Question::TARGET_DRIVER, 'answer_type' => Question::TYPE_RATING]);
        $vehicleQuestion = Question::factory()->create(['target_type' => Question::TARGET_VEHICLE, 'answer_type' => Question::TYPE_RATING]);
        $r1 = Rating::factory()->for($branch)->for($driver)->for($vehicle)->create(['submitted_at' => '2026-08-11 10:00:00']);
        $r1->answers()->create(['question_id' => $driverQuestion->id, 'answer_value' => [4]]);
        $r1->answers()->create(['question_id' => $vehicleQuestion->id, 'answer_value' => [2]]);
        $r2 = Rating::factory()->for($branch)->for($driver)->for($vehicle)->create(['submitted_at' => '2026-08-12 10:00:00']);
        $r2->answers()->create(['question_id' => $driverQuestion->id, 'answer_value' => [2]]);
        $r2->answers()->create(['question_id' => $vehicleQuestion->id, 'answer_value' => [4]]);

        $this->get(route('admin.reports.drivers'))->assertOk()->assertSee($driver->full_name)->assertSee('3');
        $this->get(route('admin.reports.vehicles'))->assertOk()->assertSee($vehicle->police_number)->assertSee('3');
    }

    private function makeEntities(): array
    {
        $branch = Branch::factory()->create();
        return [$branch, Driver::factory()->for($branch)->create(), Vehicle::factory()->for($branch)->create()];
    }

    private function makeRating(Branch $branch, Driver $driver, Vehicle $vehicle, Question $question, int $value, string $date = '2026-08-12 10:00:00'): Rating
    {
        $rating = Rating::factory()->for($branch)->for($driver)->for($vehicle)->create(['submitted_at' => $date]);
        $rating->answers()->create(['question_id' => $question->id, 'answer_value' => [$value]]);
        return $rating;
    }
}