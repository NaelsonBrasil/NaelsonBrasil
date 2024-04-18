<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save and Load Data</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em 0;
        }

        main {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 2em;
        }

        form {
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 0.5em;
        }

        input {
            width: 100%;
            padding: 0.5em;
            margin-bottom: 1em;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 0.5em 1em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        #sidebar {
            flex: 1;
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 1em;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 1em;
        }

        li strong {
            display: block;
            margin-bottom: 0.5em;
        }

        li button {
            background-color: #ff6666;
            color: #fff;
            padding: 0.3em 0.5em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        li button:hover {
            background-color: #ff3333;
        }
    </style>
</head>

<?php
session_start();

// Hardcoded username and password (replace these with your actual credentials)
$correctUser = 'keys';
$correctPass = 'online123.';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the username and password from the form submission
    $user = isset($_POST['username']) ? $_POST['username'] : '';
    $pass = isset($_POST['password']) ? $_POST['password'] : '';

    // Check if the provided credentials match the correct ones
    if ($user === $correctUser && $pass === $correctPass) {
        $_SESSION['authenticated'] = true;
        header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page after successful login
        exit();
    } else {
        $message = 'Authentication failed. Incorrect username or password.';
    }
}

// Check if the user is authenticated
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // Welcome page content
    echo '<h2>Bem vindo!</h2>';
    // echo '<p>You have successfully logged in.</p>';
    // echo '<a href="?logout=true">Logout</a>';
} else {
    // Login form content
    echo '<html lang="en">';
    echo '<head>';
    echo '    <meta charset="UTF-8">';
    echo '    <meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '    <title>Login Form</title>';
    echo '</head>';
    echo '<body>';
    echo '    <h2>Acesso</h2>';
    if (isset($message)) {
        echo '    <p style="color: red;">' . $message . '</p>';
    }
    echo '    <form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
    echo '        <label for="username">Username:</label>';
    echo '        <input type="text" id="username" name="username" required><br>';
    echo '        <label for="password">Password:</label>';
    echo '        <input type="password" id="password" name="password" required><br>';
    echo '        <input type="submit" value="Login">';
    echo '    </form>';
    echo '</body>';
    echo '</html>';
}
?>

<?php if ($_SESSION['authenticated'] == true) { ?>


    <body>

        <header>
            <h1>Sava and Carregar keys</h1>
        </header>

        <main>
            <form id="dataForm">
                <label for="email">Email:</label>
                <input type="email" id="email" required>
                <br>
                <label for="key">Key:</label>
                <input type="text" id="key" required>
                <br>
                <button type="button" onclick="saveData()">Save</button>
            </form>

            <div id="sidebar">
                <h2>Saved Data</h2>
                <ul id="dataList"></ul>
            </div>
        </main>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                updateSidebar();
            });

            fetch('http://localhost/load-storange.php')
                .then(response => response.json())
                .then(data => {
                    data.forEach((item, index) => {
                        // console.log("Index:", index);
                        // console.log("User ID:", item.id);
                        // console.log("User Email:", item.email);
                        // console.log("User Key:", item.key);
                        // console.log("---------------------");
                        // Save data to localStorage as JSON
                        localStorage.setItem(item.id, JSON.stringify(data[index]));

                    });
                    updateSidebar();
                })
                .catch(error => console.error('Error:', error));

            function saveData() {
                const email = document.getElementById('email').value;
                const key = document.getElementById('key').value;

                // Validate email format
                if (!validateEmail(email)) {
                    alert('Please enter a valid email address.');
                    return;
                }

                // Check if the email already exists in localStorage
                if (isEmailExist(email)) {
                    alert('Email already exists. Please enter a different email.');
                    return;
                }

                // Check if the email and key are not empty
                if (email && key) {
                    const data = {
                        id: generateId(),
                        email,
                        key
                    };

                    // Save data to localStorage as JSON
                    localStorage.setItem(data.id, JSON.stringify(data));

                    // Clear the form fields
                    document.getElementById('email').value = '';
                    document.getElementById('key').value = '';

                    // Update the sidebar with the saved data
                    updateSidebar();

                    // Send all data from localStorage to the server
                    saveDataToServer();
                } else {
                    alert('Please enter both email and key.');
                }
            }

            function saveDataToServer() {
                // Get all data from localStorage
                const allData = [];
                for (let i = 0; i < localStorage.length; i++) {
                    const id = localStorage.key(i);
                    const data = JSON.parse(localStorage.getItem(id));
                    allData.push(data);
                }

                // Send AJAX request to save.php to save all data on the server
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'save.php', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log('All data saved on the server.');
                    }
                };
                xhr.send(JSON.stringify({
                    action: 'save',
                    data: allData
                }));
            }

            function validateEmail(email) {
                // A simple email validation regex
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function isEmailExist(email) {
                // Check if the email already exists in localStorage
                for (let i = 0; i < localStorage.length; i++) {
                    const id = localStorage.key(i);
                    const data = JSON.parse(localStorage.getItem(id));
                    if (data && data.email === email) {
                        return true;
                    }
                }
                return false;
            }

            function generateId() {
                // Generate a random ID for each record
                return '_' + Math.random().toString(36).substr(2, 9);
            }

            function updateSidebar() {
                const dataList = document.getElementById('dataList');
                dataList.innerHTML = '';

                // Iterate through localStorage and update the sidebar
                for (let i = 0; i < localStorage.length; i++) {
                    const id = localStorage.key(i);
                    const data = JSON.parse(localStorage.getItem(id));

                    const listItem = document.createElement('li');
                    listItem.innerHTML = `<strong>ID: ${data.id}</strong>  Email: ${data.email} Key: ${data.key} <button onclick="deleteData('${id}')">Delete</button>`;
                    dataList.appendChild(listItem);
                }
            }

            function deleteData(id) {
                // Send AJAX request to save.php when deleting data
                const data = JSON.parse(localStorage.getItem(id));
                deleteDataOnServer(data);
            }

            function deleteDataOnServer(data) {
                // Send AJAX request to save.php to delete data on the server
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'save.php', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log('Data deleted on the server.');

                        // Remove data from localStorage after successful delete on the server
                        localStorage.removeItem(data.id);

                        // Update the sidebar
                        updateSidebar();
                    }
                };
                xhr.send(JSON.stringify({
                    action: 'delete',
                    data
                }));
            }
        </script>

    </body>

</html>

<?php } ?>