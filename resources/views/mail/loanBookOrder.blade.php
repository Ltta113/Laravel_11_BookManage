<!DOCTYPE html>
<html>
<head>
    <title>Mượn Sách</title>
</head>
<body>
<h1>Thông báo mượn sách</h1>
<p>Chúc mừng bạn đã mượn thành công cuốn sách: <strong>{{ $loan->book->title }}</strong></p>
<p>Tác giả: <strong>{{ $loan->book->author }}</strong></p>
<p><strong>Ngày mượn:</strong>
    {{ $loan->start_at ? \Carbon\Carbon::parse($loan->start_at)->format('d/m/Y') : 'N/A' }}</p>
<p><strong>Ngày trả:</strong>
    {{ $loan->end_at ? \Carbon\Carbon::parse($loan->end_at)->format('d/m/Y') : 'N/A' }}</p>
</body>
</html>
