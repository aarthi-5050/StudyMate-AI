<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Chat History</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            margin:30px;
        }

        h1{
            text-align:center;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table,th,td{
            border:1px solid black;
        }

        th{
            background:#f2f2f2;
        }

        th,td{
            padding:10px;
            text-align:left;
        }

    </style>

</head>

<body>

<h1>StudyMate AI Chat History</h1>

<table>

<tr>

    <th>ID</th>

    <th>Question</th>

    <th>Answer</th>

    <th>Date</th>

</tr>

@foreach($messages as $message)

<tr>

    <td>{{ $message->id }}</td>

    <td>{{ $message->question }}</td>

    <td>{{ $message->answer }}</td>

    <td>{{ $message->created_at }}</td>

</tr>

@endforeach

</table>

</body>

</html>