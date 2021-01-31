<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<div class="container">
    <nav class="mt-5">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab"
               aria-controls="nav-home" aria-selected="true">Generate Your shortcode</a>
            <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab"
               aria-controls="nav-profile" aria-selected="false">Get URL from shortcode</a>
            <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab"
               aria-controls="nav-contact" aria-selected="false">Reports of Shortcode</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div id="esc" name="esc">
                <hr>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input style="width: 50%;" type="text" id="url" name="url" class="form-control">
                </div>
                <br>
                <label for="url">Code</label>
                <div class="form-group d-flex">
                    <input style="width: 50%;margin-right: 40px;" type="text" id="code" name="code" value=""
                           class="form-control">
                    <button class="btn btn-primary" name=generate onclick="bul()" value="generate">Generate</button>
                </div>
                <br><br>

                <button class="btn btn-success" id="sumbitUrl">Submit</button>
                <br><br>
                <hr>
                <a id="resultCode" target="_blank"></a>
                <br>
                <a id="resultUrl" target="_blank" ></a>
            </div>

        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div name="getUrl">
                <hr>
                <div class="form-group">
                    <label for="searchCode">Code</label>
                    <input class="form-control" type="text" id="searchCode" name="searchCode">
                </div>
                <br>

                <button id="searchUrl" class="btn btn-success">Find Url</button>
                <hr>

                <div id="generatedCode" class="alert alert-success d-none">
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
           <div name="getReports">
                <hr>
                <div class="form-group">
                    <label for="search2Code">Code</label>
                    <input class="form-control" type="text" id="search2Code" name="search2Code">
                </div>
                <br>

                <button id="search2Url" class="btn btn-success">Get Reports</button>
                <hr>
				
				
                <div id="generated2Code" class="alert alert-success d-none">
				
                </div>
				
				<div id="generated3Code" class="alert alert-success d-none">
				
                </div>
            </div>

        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
<script>

    $(document).ready(function () {

        $('#searchUrl').click(function () {
            $('#generatedCode').addClass("d-none");
            var code  = $('#searchCode').val();

            if(checkInput(code)){
                $.ajax({
                    'url': 'form.php',
                    'type': 'GET',
                    'data': {
                        code
                    },
                    'success': function (data) {
                        var newData = JSON.parse(data)
                        if (newData.error) {
                            alert("Please Check Fields")
                        } else {
                            console.log(newData)
                            $('#generatedCode').html(newData.url);
                            $('#generatedCode').removeClass("d-none");
                        }
                    }
                });
            }
        });
		
		$('#search2Url').click(function () {
            $('#generated2Code').addClass("d-none");
            var code  = $('#search2Code').val();
			var report = 'report';

            if(checkInput(code)){
                $.ajax({
                    'url': 'form.php',
                    'type': 'GET',
                    'data': {
                        code , report
                    },
                    'success': function (data) {
                        var newData = JSON.parse(data)
                        if (newData.error) {
                            alert("Please Check Fields")
                        } else {
                            console.log(newData)
							console.log(newData.data.counter)
                            $('#generated2Code').html("Shortcode Create Date : "+newData.data.date);
                            $('#generated2Code').removeClass("d-none");
							$('#generated3Code').html("Shortcode Click Counter : "+newData.data.counter);
                            $('#generated3Code').removeClass("d-none");
                        }
                    }
                });
            }
        });
		
		
        // url kaydetme
        $('#sumbitUrl').click(function () {
            var code = $('#code').val();
            var url = $('#url').val();

            if (checkInput(code)) {
                $.ajax({
                    'url': 'form.php',
                    'type': 'POST',
                    'data': {
                        code, url
                    },
                    'success': function (data) {
                        var newData = JSON.parse(data)
                        if (newData.error) {
                            alert("Please Check Fields")
                        } else {
                            console.log(newData)
                            $('#resultUrl').html(newData.url);
                            $('#resultUrl').attr("href", "redirect.php?code="+newData.code);
                            $('#resultCode').attr("href", "redirect.php?code="+newData.code);
                            $('#resultCode').html(newData.code);
                        }
                    }
                });
            }
        });

    });

    function checkInput(elem) {
        if (elem.length < 4) {
            alert("This value at least 4 characters long!");
            return false;
        }
        return true;
    }

    function openCity(evt, cityName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("city");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.firstElementChild.className += " w3-border-red";
    }

    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    function bul() {

        let result = ' ';
        const charactersLength = characters.length;
        for (let i = 0; i < 6; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }

        console.log(result.trim());
        document.getElementById('code').value = result.trim();
        $('#resultCode').innerHTML = result.trim();
    }

    function f1() {
        var x = document.esc.url.value;
        window.open(x);
    }
	
	
</script>

</body>
</html>