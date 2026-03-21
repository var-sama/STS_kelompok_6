# Web-In

Web-In is a class discussion website designed to facilitate communication and knowledge sharing among students. Through this platform, users can ask questions, share ideas, and engage in discussions related to school subjects or other relevant topics.

This website helps students interact without needing face-to-face meetings, making discussions more flexible, efficient, and accessible anytime and anywhere.

---

## Installation

1. Clone the repository:
    ```bash
    https://github.com/var-sama/STS_kelompok_6.git
    ```

2. Navigate into the project folder:
    ```bash
    cd STS_kelompok_6
    ```

3. Run the project (no additional dependencies required since it uses only HTML, CSS, and PHP):
    ```bash
    php -S localhost:5000 -t public
    ```

4. Set up the database:
   ~ Open your database tool (phpMyAdmin, MySQL Workbench, or command line).
   ~ Create a new database "pwl-ta-db".
   ~ Import the SQL file provided in the repository ():
    ```bash
    mysql -u root -p proyek_sts < ().sql
    ```
    Or use phpMyAdmin → Import → Choose file ().sql.

---

## Usage

1. Run a local PHP server using PHP built-in server:
   ```bash
    php -S localhost:5000 -t public
   ```

2. On the landingpage, users can click Register button on the sidebar to create a new account.
   
3. Complete the registration form by providing the required data in each field.

4. Login to access features

5. After login, users can access their dashboard or profile page depending on their role.

---

## Architecture

```Project structure
sts-pwl/
  ├── index.html    ~ Main page
  ├── index.css     ~ Website styling
  ├── ###.png       ~ Supporting icons/images
  ├── ###.jpg       ~ Supporting icons/images
  └── README.md     ~ Project documentation
```

---

## Contributing

We welcome contributions from anyone who wants to help improve Web-In school problem discusion Website!
Whether you are fixing bugs, adding new features, enhancing the design, or improving documentation, your contributions are highly appreciated.

### How to Contribute

1. Fork this repository.
2. Create a new branch for your feature or bugfix.
3. Commit your changes with a clear and descriptive message.
4. Push your branch and open a Pull Request.
5. Wait for review and feedback before merging.

### Contribution Guidelines
- Keep your code clean, structured, and well-documented.
- Ensure that any new features or fixes are properly tested.
- Maintain consistency with the existing project structure.
- Be respectful, collaborative, and constructive in discussions.

> Together, we can make Web-In a more accessible and user-friendly platform for school discusion! 

---

## License
This project is licensed under the MIT License.
You are free to use, modify, and redistribute it as long as proper credit is given.

---

## Team Members
1. Gervasio Velasques
2. Edwin Jonathan
3. Michael Leonardo
4. Willyansen Alexander Jonathan
