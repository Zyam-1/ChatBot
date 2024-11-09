<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>Bot AI</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9f9f9;
            margin: 0;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            align-items: stretch;
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #7386D5;
            color: #fff;
            transition: all 0.3s;
            padding-top: 10px;
        }

        #sidebar.active {
            margin-left: -250px;
        }

        #sidebar .sidebar-header {
            padding: 15px;
            text-align: center;
            background: #6d7fcc;
        }

        #sidebar ul.components {
            padding: 0;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
            color: #ffffff;
        }

        #sidebar ul li a:hover {
            background: #fff;
            color: #7386D5;
        }

        #content {
            flex: 1;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            padding: 10px 15px;
            background: #fff;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .MessagesContainer {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
            background: #fafafa;
            display: flex;
            flex-direction: column;
        }

        .message {
            max-width: 60%;
            margin: 5px 0;
            padding: 10px;
            border-radius: 8px;
            word-wrap: break-word;
        }

        .sent {
            align-self: flex-end;
            background-color: #7386D5;
            color: #fff;
        }

        .received {
            align-self: flex-start;
            background-color: #e5e5ea;
            color: #333;
        }

        .message-input-container {
            padding: 10px;
            background: #f5f5f5;
            position: sticky;
            bottom: 0;
            display: flex;
            align-items: center;
        }

        #message {
            resize: none;
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-right: 10px;
            outline: none;
        }

        #sendBtn {
            background-color: #7386D5;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4>Bot AI</h4>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a href="#">Home 1</a></li>
                        <li><a href="#">Home 2</a></li>
                        <li><a href="#">Home 3</a></li>
                    </ul>
                </li>
                <li><a href="#">About</a></li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">Pages</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                </li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <div id="userProfile" class="text-center p-3">
                <p>{{ auth()->user()->name }}</p>
                <a href="{{ route('logout') }}" title="Logout" class="text-white"><i
                        class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Top Navbar -->
            <nav class="navbar">
                <button type="button" id="sidebarCollapse" class="btn btn-sm btn-light">
                    <i class="fas fa-align-left"></i>
                    <span id="toggleChats">Hide Chats</span>
                </button>
            </nav>

            <!-- Messages Section -->
            <div class="MessagesContainer" id="messageContainer">
                <!-- Messages will appear here -->
                <div class="message received">asdasdass</div>
            </div>

            <!-- Message Input -->
            <div class="message-input-container">
                <textarea id="message" class="txtMessage" rows="1" placeholder="Type your message here..."></textarea>
                <button id="sendBtn"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Sidebar toggle
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $("#toggleChats").text($('#sidebar').hasClass('active') ? "Show Chats" : "Hide Chats");
            });

            // Message sending
            $('#sendBtn').click(function () {
                sendMessage();
            });

            $('#message').keypress(function (e) {
                if (e.which == 13 && !e.shiftKey) {
                    sendMessage();
                    e.preventDefault();
                }
            });

            function sendMessage() {
                let message = $('#message').val().trim();
                if (message) {
                    $('#messageContainer').append(`<div class="message sent">${message}</div>`);
                    scrollToBottom();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('sendMessage') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            message: message
                        },
                        success: function (res) {
                            console.log(res);
                        }
                    })
                }

                //send Message to Gemini

                $('#message').val('');

            }

            function scrollToBottom() {
                $('#messageContainer').animate({
                    scrollTop: $('#messageContainer')[0].scrollHeight
                }, 300);
            }

        });

    </script>
</body>

</html>
