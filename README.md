##2603-KAWAKATSU.Ryota  
2026年3月卒業　川勝涼太

## Overview
This repository provides a collection of Proof of Concept (PoC) environments for vulnerabilities reported in **Laravel** and **Livewire** between 2024 and 2025.  
Each PoC compares the behavior of a vulnerable version and its corresponding patched version in a reproducible environment.

Laravel is widely used in real-world web applications, yet there are limited resources that clearly demonstrate **under what conditions vulnerabilities occur and how their behavior changes after fixes**.  
This project aims to clarify these points through executable PoC implementations.

---

## Description
This study constructs PoC environments for the following vulnerabilities and compares their behavior by running vulnerable and patched versions in parallel.

- **CVE-2024-52301**  
  An issue where HTTP request input is interpreted as CLI arguments, allowing external input to change the Laravel execution environment (e.g., `--env`).

- **CVE-2024-13918**  
  A reflected XSS vulnerability in the debug exception page, where user input is not properly escaped.

- **CVE-2025-27515**  
  An input validation bypass in wildcard validation (`files.*`) caused by specific input key formats.

- **CVE-2025-54068 (Livewire)**  
  A model substitution vulnerability caused by improper state restoration in Livewire, allowing unauthorized model manipulation.

For each PoC, the same input is applied to both versions to confirm that the vulnerability is exploitable in the vulnerable version and properly mitigated in the patched version.

---

## Requirements
- Docker / Docker Compose  
- PHP / Laravel  

Detailed framework and library versions are described in the README of each CVE directory.

---

## Install / Usage
Refer to the README in each CVE directory for detailed reproduction steps, startup procedures, and verification methods.

---

## Author
Ryota Kawakatsu  

---

## References
- https://www.cve.org/CVERecord?id=CVE-2024-52301
- https://www.cve.org/CVERecord?id=CVE-2024-13918
- https://www.cve.org/CVERecord?id=CVE-2025-27515
- https://www.cve.org/CVERecord?id=CVE-2025-54068
- https://laravel.com
- https://livewire.laravel.com

---

## License
MIT
