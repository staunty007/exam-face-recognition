const video = document.getElementById('video')
const snap = document.getElementById("snap")
const getCvs = document.getElementById("canvas");
const upload = document.getElementById("upload")
let uploadedImage;
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
    //$('#user').html("Loading....");

    //console.log("Loading......");

    if(navigator.onLine == false) {
        console.log("No Internet Connection")
        return;
    }
    cvs = getCvs
    const context = cvs.getContext("2d");
    context.drawImage(video, 0, 0, 320, 240);
    var pngUrl = cvs.toDataURL();
    if (cvs) cvs.remove()
    $("#preview").attr('src', pngUrl);
    uploadedImage = pngUrl;


    // var file_data = dataURLtoFile(pngUrl, 'newFile.jpg')
	// var form_data = new FormData();


    // form_data.append('file', file_data);

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


$('#submit').click(function (e) {
	e.preventDefault()

    var file_data = dataURLtoFile(uploadedImage, 'newFile.jpg')
	var form_data = new FormData();

    form_data.append('file', file_data);

	$.ajax({
		url: 'api/pre-capture.php', // point to server-side PHP script 
		dataType: 'text', // what to expect back from the PHP script, if anything
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: 'post',
		success: function (data) {
            data = JSON.parse(data);
            if (data.success) {
               // console.log(data.success); // display response from the PHP script, if any
                $("#success-msg").html(data.success)
                setTimeout(() => {
                    location.href = "/logout.php";
                }, 3000);
            } else {
                console.log(data.error);
            }
		}
	});
})
