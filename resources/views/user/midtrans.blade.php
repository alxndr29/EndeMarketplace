<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-ZXG2YBvaF0n8pvHq"></script>

    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
</head>

<body>
    <button id="pay-button">Pay!</button>
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        // For example trigger on button clicked, or any time you need
        payButton.addEventListener('click', function() {
            //snap.pay('{{$snapToken}}'); // Replace it with your transaction token
            snap.pay('{{$snapToken}}', {
                onSuccess: function(result) {
                    console.log('success');
                    console.log(result);
                    
                },
                onPending: function(result) {
                    console.log('pending');
                    console.log(result);
                },
                onError: function(result) {
                    console.log('error');
                    console.log(result);
                },
                onClose: function() {
                    console.log('customer closed the popup without finishing the payment');
                }
            })

        });
    </script>
</body>

</html>