# FakeGen ⚡

> Generate realistic fake data in seconds — free, private, no signups.

FakeGen is an open-source fake data generator built for developers who need realistic test data fast. No accounts, no tracking, no nonsense.

**Live demo:** https://fakegen.infinityfreeapp.com/

---

## ✨ Features

- 🎲 Generate names, usernames, emails, phone numbers, passwords, URLs, dates, colors, and full user profiles
- 🔢 Generate up to 10,000 items at once (the page previews the first 50; Copy and Download include everything)
- 🔐 Customizable passwords: choose length and character sets
- 📤 Export as JSON, CSV, SQL, or XML, with one-click copy or download
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

## 📤 Export Formats

| Format | Notes                                                                             |
| ------ | --------------------------------------------------------------------------------- |
| JSON   | Plain strings are wrapped as `{ "type": "value" }`; objects stay as-is            |
| CSV    | Nested fields are flattened (`favorite_color_hex`); values are quoted when needed |
| SQL    | A single multi-row `INSERT INTO fakegen_<type>` statement                         |
| XML    | One `<record>` per item inside a `<records>` root                                 |

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

Example responses:

```json
["James Smith", "Emily Brooks", "Daniel Rivera"]
```

```json
[
  {
    "name": "Olivia Carter",
    "email": "olivia.carter@proton.me",
    "phone": "+966 512345678",
    "password": "m7@Q!xP2#Ld9aB4k",
    "favorite_color": {
      "hex": "#2F98D4",
      "rgb": "rgb(47,152,212)",
      "hsl": "hsl(201,64%,51%)"
    }
  }
]
```

The API always returns JSON. Export formats (CSV, SQL, XML) are produced by the web interface.

Invalid input returns HTTP `422` with a `message` field, and non-POST requests return `405`. The API sends `Access-Control-Allow-Origin: *`, so it can be called from other websites' JavaScript.

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
- Vanilla JavaScript — fetch API, export formats, copy, download
- PHPUnit — tests

---

## 🗺 Roadmap

- [x] Names, emails, and phone numbers
- [x] Colors and passwords
- [x] Multi-type generation (full user profiles)
- [x] More data types (usernames, URLs, dates)
- [x] Export formats (CSV, SQL, XML)
- [ ] Address generation
- [ ] Searchable data type dropdown
- [ ] Custom schema builder

Ideas and contributions are welcome — feel free to open an issue.

---

## 📄 License

MIT — see [LICENSE](LICENSE).

---

## 👨‍💻 Author

Built by [Mustafa](https://mustafa-azmi.netlify.app/) — check out my portfolio and other projects!
