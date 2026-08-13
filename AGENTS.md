# AGENTS.md

## Project

This repository contains a Laravel-based Driver and Vehicle Rating System.

The system allows passengers to scan a vehicle QR code, view vehicle information, select an available driver from the same branch, submit a rating, and store the assessment for administrative monitoring and reporting.

## Main References

Before implementing features, read:

1. `PROJECT_SPEC_PENILAIAN_DRIVER_V3.md`
2. `aplikasi penilaian driver.pdf`

### Source of Truth

Functional requirements:
`PROJECT_SPEC_PENILAIAN_DRIVER_V3.md`

Visual/UI reference:
`aplikasi penilaian driver.pdf`

If a requirement is not defined, do not invent complex business rules.

## Technology

Use:

- Laravel
- PHP
- MySQL
- Blade
- Eloquent ORM
- Laravel migrations
- Form Requests / validation
- Policies / authorization
- JavaScript
- CSS
- QR Code generation

## Important Business Rules

1. A driver belongs to one branch.
2. A vehicle belongs to one branch.
3. A driver is NOT permanently assigned to one vehicle.
4. A driver can use multiple vehicles within the same branch.
5. When a passenger scans a vehicle QR code, only active drivers from the same branch can be selected.
6. Inactive vehicles cannot be rated.
7. Inactive drivers cannot be selected.
8. Inactive questions must not appear in passenger assessment forms.
9. Questions follow `sort_order ASC`.
10. Rating answers use values 1–5.
11. Yes/No answers use:
    - Yes = 1
    - No = 0
12. Do not mix Yes/No 0/1 values into the 1–5 rating average.
13. Validate all business rules on the server.
14. Do not trust IDs received from the browser without server-side validation.

## UI Requirements

The UI must closely follow the provided PDF.

Do not replace the design with:

- AdminLTE
- generic Bootstrap dashboard
- generic Tailwind dashboard
- unrelated dashboard templates

The visual language should follow the PDF:

- dark/navy sidebar
- clean light content area
- blue primary accent
- rounded cards
- modern tables
- statistic cards
- charts
- modern typography
- responsive layouts
- mobile-first passenger flow

## Development Rules

Before implementing a major feature:

1. Inspect the existing code.
2. Identify the relevant files.
3. Explain the implementation plan.
4. Implement the smallest coherent change.
5. Run relevant tests/checks.
6. Fix errors.
7. Review the resulting diff.
8. Do not modify unrelated files.

## Do Not

- Do not hardcode master data.
- Do not hardcode questions.
- Do not hardcode drivers.
- Do not hardcode vehicles.
- Do not create fake data in production logic.
- Do not introduce unnecessary packages.
- Do not change business rules without explicit instruction.
- Do not rewrite working code unnecessarily.

## Quality

Every implemented feature should be:

- database-backed
- validated
- authorized where necessary
- responsive
- reusable
- tested where practical
- visually consistent with the PDF