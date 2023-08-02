
<html>

<body>
    <h1>Special Offer for Our Valued Customers from {{ $name }}</h1>
    <p>Here is your special promotion message!</p>
    <!-- Customize the content of the promotional email as needed -->
    <img src="{{ $message->embed(Storage::path('public/discount.jpg')) }}">
</body>

</html>
