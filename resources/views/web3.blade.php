<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MetaMask Login</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('js/ethers.umd.min.js')}}"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <button class="btn btn-primary mt-5" onclick="web3Login()">Log in with MetaMask</button>
        </div>
    </div>
</div>
</body>
<script>
    async function web3Login() {
        if (!window.ethereum) {
            alert('MetaMask not detected. Please install MetaMask first.');
            return;
        }

        const provider = new ethers.providers.Web3Provider(window.ethereum);
        //
        let response = await fetch('/web3-login-message');
        const message = await response.text();

        await provider.send("eth_requestAccounts", []);
        const address = await provider.getSigner().getAddress();
        console.log(address);
        const signature = await provider.getSigner().signMessage(message);

        response = await fetch('/web3-login-verify', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                'address': address,
                'signature': signature,
                '_token': '{{ csrf_token() }}'
            })
        });
        const data = await response.text();

        console.log(data);
    }
</script>
</html>