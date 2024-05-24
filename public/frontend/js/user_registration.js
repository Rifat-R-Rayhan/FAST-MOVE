
let next_btn = document.getElementById('next_btn');
let previous_btn = document.getElementById('previous_btn');
let submit_btn = document.getElementById('submit_btn');
let link_home = document.getElementById('link_home');
let button_content = document.getElementById('button_content');
let contents = [
    document.getElementById('content1'),
    document.getElementById('content2'),
    document.getElementById('content3')
];
let counter = 0;

submit_btn.style.display = 'none';

for (let i = 1; i < contents.length; i++) {
    contents[i].style.transition = 'left 0.5s ease';
    contents[i].style.left = '-800px';
    contents[i].style.display = 'none';
}

next_btn.addEventListener("click", function () {
    if (counter < contents.length - 1) {
        contents[counter].style.left = '-800px';
        contents[counter].style.opacity = '0';
        setTimeout(function () {
            contents[counter].style.display = 'none';
            counter++;
            contents[counter].style.left = '0';
            contents[counter].style.opacity = '1';
            contents[counter].style.display = 'block';

            if (counter === 1) {
                previous_btn.style.display = 'block';
                button_content.classList.add('justify-content-between');
            }

            if (counter === contents.length - 1) {
                submit_btn.style.display = 'block';
                next_btn.style.display = 'none';
                previous_btn.style.marginTop = '-38px';
                button_content.classList.add('justify-content-between');
                link_home.classList.add('link_home');
            }
        }, 500);
    }
});

previous_btn.addEventListener("click", function () {
    if (counter > 0) {
        contents[counter].style.left = '800px';
        contents[counter].style.opacity = '0';
        setTimeout(function () {
            contents[counter].style.display = 'none';
            counter--;
            contents[counter].style.left = '0';
            contents[counter].style.opacity = '1';
            contents[counter].style.display = 'block';

            if (counter === 0) {
                previous_btn.style.display = 'none';
                button_content.classList.remove('justify-content-between');
            }
            if (counter === contents.length - 2) {
                submit_btn.style.display = 'none';
                next_btn.style.display = 'block';
                previous_btn.style.marginTop = '0';
                link_home.style.marginTop = '0';
                link_home.style.marginRight = '0';
            }
        }, 500);
    }
});
if (submit_btn.style.display === 'block') {
    link_home.style.marginTop = '0';
    link_home.style.marginRight = '0';
}

function showImageInput() {
    var fileInput = document.getElementById('fileInput');
    fileInput.click();
}

function handleFileSelect() {
    var fileInput = document.getElementById('fileInput');
    var hiddenDiv = document.getElementById('hiddenDiv');
    var selectedImage = document.getElementById('selectedImage');

    if (fileInput.files && fileInput.files[0]) {
        selectedImage.src = URL.createObjectURL(fileInput.files[0]);
        hiddenDiv.style.display = 'block';
    }
}

function frontshowImageInput() {
    var frontfileInput = document.getElementById('frontfileInput');
    frontfileInput.click();
}

function fronthandleFileSelect() {
    var frontfileInput = document.getElementById('frontfileInput');
    var hiddenDivFront = document.getElementById('hiddenDivFront');
    var selectedImageFront = document.getElementById('selectedImageFront');

    if (frontfileInput.files && frontfileInput.files[0]) {
        selectedImageFront.src = URL.createObjectURL(frontfileInput.files[0]);
        hiddenDivFront.style.display = 'block';
    }
}

function backshowImageInput() {
    var backfileInput = document.getElementById('backfileInput');
    backfileInput.click();
}

function backhandleFileSelect() {
    var backfileInput = document.getElementById('backfileInput');
    var backhiddenDivFront = document.getElementById('backhiddenDiv');
    var backselectedImage = document.getElementById('backselectedImage');

    if (backfileInput.files && backfileInput.files[0]) {
        backselectedImage.src = URL.createObjectURL(backfileInput.files[0]);
        backhiddenDivFront.style.display = 'block';
    }
}