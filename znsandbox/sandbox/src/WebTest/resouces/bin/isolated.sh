#!/bin/sh
php isolated http:request:run --factory-class="App\Application\Common\Factories\HttpKernelFactory" "Tzo0MDoiU3ltZm9ueVxDb21wb25lbnRcSHR0cEZvdW5kYXRpb25cUmVxdWVzdCI6MjU6e3M6MTA6ImF0dHJpYnV0ZXMiO086NDU6IlN5bWZvbnlcQ29tcG9uZW50XEh0dHBGb3VuZGF0aW9uXFBhcmFtZXRlckJhZyI6MTp7czoxMzoiACoAcGFyYW1ldGVycyI7YTowOnt9fXM6NzoicmVxdWVzdCI7Tzo0MToiU3ltZm9ueVxDb21wb25lbnRcSHR0cEZvdW5kYXRpb25cSW5wdXRCYWciOjE6e3M6MTM6IgAqAHBhcmFtZXRlcnMiO2E6MDp7fX1zOjU6InF1ZXJ5IjtPOjQxOiJTeW1mb255XENvbXBvbmVudFxIdHRwRm91bmRhdGlvblxJbnB1dEJhZyI6MTp7czoxMzoiACoAcGFyYW1ldGVycyI7YTowOnt9fXM6Njoic2VydmVyIjtPOjQyOiJTeW1mb255XENvbXBvbmVudFxIdHRwRm91bmRhdGlvblxTZXJ2ZXJCYWciOjE6e3M6MTM6IgAqAHBhcmFtZXRlcnMiO2E6MTk6e3M6MTE6IlNFUlZFUl9OQU1FIjtzOjk6ImxvY2FsaG9zdCI7czoxMToiU0VSVkVSX1BPUlQiO2k6ODA7czo5OiJIVFRQX0hPU1QiO3M6OToibG9jYWxob3N0IjtzOjE1OiJIVFRQX1VTRVJfQUdFTlQiO3M6NzoiU3ltZm9ueSI7czoxMToiSFRUUF9BQ0NFUFQiO3M6MTY6ImFwcGxpY2F0aW9uL2pzb24iO3M6MjA6IkhUVFBfQUNDRVBUX0xBTkdVQUdFIjtzOjE0OiJlbi11cyxlbjtxPTAuNSI7czoxOToiSFRUUF9BQ0NFUFRfQ0hBUlNFVCI7czozMDoiSVNPLTg4NTktMSx1dGYtODtxPTAuNywqO3E9MC43IjtzOjExOiJSRU1PVEVfQUREUiI7czo5OiIxMjcuMC4wLjEiO3M6MTE6IlNDUklQVF9OQU1FIjtzOjA6IiI7czoxNToiU0NSSVBUX0ZJTEVOQU1FIjtzOjA6IiI7czoxNToiU0VSVkVSX1BST1RPQ09MIjtzOjg6IkhUVFAvMS4xIjtzOjEyOiJSRVFVRVNUX1RJTUUiO2k6MTY3MzA4NjQwMztzOjE4OiJSRVFVRVNUX1RJTUVfRkxPQVQiO2Q6MTY3MzA4NjQwMy4zNjIyNDk7czoxOToiSFRUUF9DT05URU5UX0xFTkdUSCI7aToxMjE7czoxMjoiQ09OVEVOVF9UWVBFIjtzOjE2OiJhcHBsaWNhdGlvbi9qc29uIjtzOjk6IlBBVEhfSU5GTyI7czowOiIiO3M6MTQ6IlJFUVVFU1RfTUVUSE9EIjtzOjQ6IlBPU1QiO3M6MTE6IlJFUVVFU1RfVVJJIjtzOjg6Impzb24tcnBjIjtzOjEyOiJRVUVSWV9TVFJJTkciO3M6MDoiIjt9fXM6NToiZmlsZXMiO086NDA6IlN5bWZvbnlcQ29tcG9uZW50XEh0dHBGb3VuZGF0aW9uXEZpbGVCYWciOjE6e3M6MTM6IgAqAHBhcmFtZXRlcnMiO2E6MTp7czo2OiJwYXJhbXMiO2E6MTp7czo0OiJib2R5IjthOjA6e319fX1zOjc6ImNvb2tpZXMiO086NDE6IlN5bWZvbnlcQ29tcG9uZW50XEh0dHBGb3VuZGF0aW9uXElucHV0QmFnIjoxOntzOjEzOiIAKgBwYXJhbWV0ZXJzIjthOjA6e319czo3OiJoZWFkZXJzIjtPOjQyOiJTeW1mb255XENvbXBvbmVudFxIdHRwRm91bmRhdGlvblxIZWFkZXJCYWciOjI6e3M6MTA6IgAqAGhlYWRlcnMiO2E6Nzp7czo0OiJob3N0IjthOjE6e2k6MDtzOjk6ImxvY2FsaG9zdCI7fXM6MTA6InVzZXItYWdlbnQiO2E6MTp7aTowO3M6NzoiU3ltZm9ueSI7fXM6NjoiYWNjZXB0IjthOjE6e2k6MDtzOjE2OiJhcHBsaWNhdGlvbi9qc29uIjt9czoxNToiYWNjZXB0LWxhbmd1YWdlIjthOjE6e2k6MDtzOjE0OiJlbi11cyxlbjtxPTAuNSI7fXM6MTQ6ImFjY2VwdC1jaGFyc2V0IjthOjE6e2k6MDtzOjMwOiJJU08tODg1OS0xLHV0Zi04O3E9MC43LCo7cT0wLjciO31zOjE0OiJjb250ZW50LWxlbmd0aCI7YToxOntpOjA7aToxMjE7fXM6MTI6ImNvbnRlbnQtdHlwZSI7YToxOntpOjA7czoxNjoiYXBwbGljYXRpb24vanNvbiI7fX1zOjE1OiIAKgBjYWNoZUNvbnRyb2wiO2E6MDp7fX1zOjEwOiIAKgBjb250ZW50IjtzOjEyMToieyJqc29ucnBjIjoiMi4wIiwibWV0aG9kIjoiYXV0aGVudGljYXRpb24uZ2V0VG9rZW5CeVBhc3N3b3JkIiwicGFyYW1zIjp7ImJvZHkiOnsibG9naW4iOiJhZG1pbiIsInBhc3N3b3JkIjoiV3d3cXFxMTExIn19fSI7czoxMjoiACoAbGFuZ3VhZ2VzIjtOO3M6MTE6IgAqAGNoYXJzZXRzIjtOO3M6MTI6IgAqAGVuY29kaW5ncyI7TjtzOjI1OiIAKgBhY2NlcHRhYmxlQ29udGVudFR5cGVzIjtOO3M6MTE6IgAqAHBhdGhJbmZvIjtOO3M6MTM6IgAqAHJlcXVlc3RVcmkiO047czoxMDoiACoAYmFzZVVybCI7TjtzOjExOiIAKgBiYXNlUGF0aCI7TjtzOjk6IgAqAG1ldGhvZCI7TjtzOjk6IgAqAGZvcm1hdCI7TjtzOjEwOiIAKgBzZXNzaW9uIjtOO3M6OToiACoAbG9jYWxlIjtOO3M6MTY6IgAqAGRlZmF1bHRMb2NhbGUiO3M6MjoiZW4iO3M6NTc6IgBTeW1mb255XENvbXBvbmVudFxIdHRwRm91bmRhdGlvblxSZXF1ZXN0AHByZWZlcnJlZEZvcm1hdCI7TjtzOjUzOiIAU3ltZm9ueVxDb21wb25lbnRcSHR0cEZvdW5kYXRpb25cUmVxdWVzdABpc0hvc3RWYWxpZCI7YjoxO3M6NTg6IgBTeW1mb255XENvbXBvbmVudFxIdHRwRm91bmRhdGlvblxSZXF1ZXN0AGlzRm9yd2FyZGVkVmFsaWQiO2I6MTtzOjY0OiIAU3ltZm9ueVxDb21wb25lbnRcSHR0cEZvdW5kYXRpb25cUmVxdWVzdABpc1NhZmVDb250ZW50UHJlZmVycmVkIjtOO30"