const video = document.getElementById('video')
const snap = document.getElementById("snap")
const getCvs = document.getElementById("canvas");
const upload = document.getElementById("upload")
let warning
let fullUser

function startVideo() {
	navigator.getUserMedia({
			video: {}
		},
		stream => video.srcObject = stream,
		err => console.log(err)
	)
}

startVideo()


$('.loaded').html('loading please wait....')

const noOfFails = [];
$("#no-of-fails").html(noOfFails.length);

async function verifyWithDB(image) {
    let newImage = image;
    await $.ajax({
		url: 'api/home.php', // point to server-side PHP script 
		dataType: 'text', // what to expect back from the PHP script, if anything
		cache: false,
		contentType: false,
		processData: false,
		data: newImage,
		type: 'post',
		success: function (res) {
            res = JSON.parse(res);
            if(res.success) {
                const response = { ...res.success }
				$('#user').html("Match Confirmed.  " + response.Similarity.toFixed(2) + '%');
				setTimeout(() => {
					location.href = "dashboard.php"
				}, 2000);
                console.log("Done......")
            }else {
				$("#user").html(res.error);
				noOfFails.push("Fail");

				if (noOfFails.length == 3) {
					location.href = "logout.php";
					return;
				}
				
				$("#no-of-fails").html(noOfFails.length);
            }
		}
    });
}


snap.addEventListener("click", function (e) {
    e.preventDefault();
    $('#user').html("Loading....");

    console.log("Loading......");

    if(navigator.onLine == false) {
        console.log("No Internet Connection")
        return;
    }
    cvs = getCvs
    const context = cvs.getContext("2d");
    context.drawImage(video, 0, 0, 320, 240);
    var pngUrl = cvs.toDataURL();
    var file_data = dataURLtoFile(pngUrl, 'newFile.jpg')
	var form_data = new FormData();

    $("#preview").attr('src', pngUrl);
    if (cvs) cvs.remove()

    form_data.append('file', file_data);
    
    verifyWithDB(form_data);

});

function dataURLtoFile(dataurl, filename) {
	var arr = dataurl.split(','),
		mime = arr[0].match(/:(.*?);/)[1],
		bstr = atob(arr[1]),
		n = bstr.length,
		u8arr = new Uint8Array(n);
	while (n--) {
		u8arr[n] = bstr.charCodeAt(n);
	}
	return new File([u8arr], filename, {
		type: mime
	});
}


function verifiyIdentityWithDB(user) {
	let authName = $('#auth-name').val();
  	$.post( "api/verify.php", { username: user, authname: authName })
	.done(function( data ) {   
		data = JSON.parse(data);
		if(data.success) {
			alert(data.success);
			location.href = "dashboard.php";
		}else {
			alert(data.error);
		}
	});
}

$('#upload').click(function (e) {
	e.preventDefault()
	$("#card").addClass('d-none')
	$('#capture-body').removeClass('d-none');
	console.log("Captured")

	cvs = getCvs
	const context = cvs.getContext("2d");
	context.drawImage(video, 0, 0, 320, 240);
	//var cvs = document.getElementById("canvas");
	console.log(cvs);
	var pngUrl = cvs.toDataURL();
	console.log(pngUrl);
	//var bl = convertToBlob(pngUrl)
	var file_data = dataURLtoFile(pngUrl, '2.jpg')
	var form_data = new FormData();
	console.log(file_data)
	//$("#cap-img").remove()
	//$("#capture-body").prepend(image);

	form_data.append('file', file_data);
	alert(form_data);
	$.ajax({
		url: 'upload.php', // point to server-side PHP script 
		dataType: 'text', // what to expect back from the PHP script, if anything
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: 'post',
		success: function (php_script_response) {
			alert(php_script_response); // display response from the PHP script, if any
		}
	});
})
