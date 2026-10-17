# FakeGen ⚡

> Generate realistic fake data in seconds — free, private, no signups.

FakeGen is an open-source fake data generator built for developers who need realistic test data fast. No accounts, no tracking, no nonsense.

**Live demo:** https://fakegen.infinityfreeapp.com/

---

## ✨ Features

- 🎲 Generate names, usernames, emails, phone numbers, passwords, URLs, dates, colors, and full user profiles
- 🔢 Generate up to 10,000 items at once
- 🔐 Customizable passwords: choose length and character sets
- 📋 Copy results to clipboard with one click
- 💾 Download generated data as a `.json` file
- 🔌 Simple HTTP API you can call from your own scripts
- 🔒 Zero data collection — nothing is stored or tracked
- ⚡ Fast and lightweight, no build step

---

## 📦 Data Types

| Type         | Example                                                        |
| ------------ | -------------------------------------------------------------- |
| Name         | James Smith                                                    |
| Username     | james_smith42                                                  |
| Email        | james.smith@gmail.com                                          |
| Phone        | +44 759284732                                                  |
| Password     | m7@Q!xP2#Ld9                                                   |
| URL          | https://www.harrison-labs.io/about                             |
| Date         | 1994-07-23                                                     |
| Color        | `#2F98D4`, `rgb(47,152,212)`, `hsl(201,64%,51%)`               |
| User Profile | Name, email, phone, password, and favorite color in one object |

---

## 🔌 API

Send a `POST` request to `api/generate.php`.

| Parameter   | Description                                                                      | Default  |
| ----------- | -------------------------------------------------------------------------------- | -------- |
| `type`      | `name`, `username`, `email`, `phone`, `password`, `url`, `date`, `color`, `user` | required |
| `quantity`  | Number of items, from 1 to 10,000                                                | required |
| `length`    | Password length, from 4 to 256 (passwords and users)                             | 16       |
| `uppercase` | Include uppercase letters (`true`/`false`)                                       | true     |
| `lowercase` | Include lowercase letters                                                        | true     |
| `numbers`   | Include digits                                                                   | true     |
| `symbols`   | Include symbols                                                                  | true     |

Example:

```bash
curl -X POST http://localhost:8000/api/generate.php -d "type=name&quantity=3"
```

> **Windows PowerShell users:** use `curl.exe` instead of `curl`, since PowerShell aliases `curl` to a different command.

The response is a JSON array. Invalid input returns HTTP `422` with a `message` field, and non-POST requests return `405`.

---

## 🚀 Running Locally

1. Clone the repo

```bash
git clone https://github.com/Mustafa21102005/fakegen.git
cd fakegen
```

2. Start a PHP server

```bash
php -S localhost:8000
```

Any other PHP server (XAMPP, Laragon, etc.) works too.

3. Open `http://localhost:8000` in your browser

---

## 🧪 Running Tests

```bash
composer install
vendor/bin/phpunit
```

---

## 🛠 Tech Stack

- PHP — data generation and API
- HTML / Tailwind CSS / DaisyUI — frontend
- Vanilla JavaScript — fetch API, copy, download
- PHPUnit — tests

---

## 🗺 Roadmap

- [x] Names, emails, and phone numbers
- [x] Colors and passwords
- [x] Multi-type generation (full user profiles)
- [x] More data types (usernames, URLs, dates)
- [ ] Address generation
- [ ] More export formats (CSV, SQL, XML)
- [ ] Locale support (names and phone formats by country)
- [ ] Seeded generation for reproducible output
- [ ] Custom schema builder

Ideas and contributions are welcome — feel free to open an issue.

---

## 📄 License

MIT — see [LICENSE](LICENSE).

---

## 👨‍💻 Author

Built by [Mustafa](https://mustafa-azmi.netlify.app/) — check out my portfolio and other projects!
