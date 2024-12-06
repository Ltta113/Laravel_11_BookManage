<!DOCTYPE html>
<html>

<head>
    <title>Số Sách Trong Kho Ngày {{ \Carbon\Carbon::now()->format('d/m/Y') }}</title>
</head>

<body>
<h1>Số Sách Trong Kho Ngày {{ \Carbon\Carbon::now()->format('d/m/Y') }}</h1>
<div>
    <div>
        <h1>Danh sách các sách</h1>
    </div>
    <table border="1">
        <thead>
        <tr>
            <th>Tiêu đề</th>
            <th>Tác giả</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>

</html>
