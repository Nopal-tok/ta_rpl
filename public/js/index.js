document.addEventListener('DOMContentLoaded', function () {
    const likeBtn = document.getElementById('saveBtn');
    const likeOutline = document.getElementById('iconOutline');
    const likeFill = document.getElementById('iconFill');

    likeBtn.addEventListener('click', function () {
        likeOutline.classList.toggle('hidden');
        likeFill.classList.toggle('hidden');
    });
});

document.querySelectorAll('.toggle-pass').forEach(toggle => {
    toggle.addEventListener('click', function () {
        const targetId = this.getAttribute('data-target');
        const input = document.getElementById(targetId);

        const eyeOpen = this.querySelector('.eye-open');
        const eyeClosed = this.querySelector('.eye-closed');

        if (input.type === "password") {
            input.type = "text";
            eyeOpen.style.display = "block";
            eyeClosed.style.display = "none";
        } else {
            input.type = "password";
            eyeOpen.style.display = "none";
            eyeClosed.style.display = "block";
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const cvUploadCard = document.getElementById('cvUploadCard');
    const cvInputFile = document.getElementById('cvInputFile');
    const cvDropArea = document.getElementById('cvDropArea');
    const fileNameDisplay = cvDropArea.querySelector('p.fw-normal');
    const fileLimitText = cvDropArea.querySelector('p.text-secondary');

    const defaultFileNameText = 'Upload your PDF here -';
    const defaultLimitText = 'up to 10 MB';
    const activeDragClass = 'drag-active';

    const handleFileSelection = (fileList) => {
        if (fileList.length > 0) {
            const file = fileList[0];

            cvInputFile.files = fileList;

            fileNameDisplay.textContent = file.name;
            fileLimitText.textContent = `Size: ${(file.size / 1024 / 1024).toFixed(2)} MB (PDF)`;
            cvUploadCard.classList.add('file-selected');

            console.log("File selected/dropped:", file.name);
        } else {
            fileNameDisplay.textContent = defaultFileNameText;
            fileLimitText.textContent = defaultLimitText;
            cvUploadCard.classList.remove('file-selected');
        }
    };

    cvInputFile.addEventListener('change', (event) => {
        handleFileSelection(event.target.files);
    });

    cvDropArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        cvUploadCard.classList.add(activeDragClass);
    });

    cvDropArea.addEventListener('dragleave', () => {
        cvUploadCard.classList.remove(activeDragClass);
    });

    cvDropArea.addEventListener('drop', (event) => {
        event.preventDefault();
        cvUploadCard.classList.remove(activeDragClass);
        handleFileSelection(event.dataTransfer.files);
    });
});

const sendBtn = document.getElementById('sendBtn');
const emailInput = document.getElementById('emailInput');
const timerDisplay = document.getElementById('timerDisplay');

let cooldown = 60;

sendBtn.addEventListener('click', function(e) {
    e.preventDefault();

    if (!emailInput.value) {
        alert("Masukin email dulu bro!");
        return;
    }

    // disable tombol, tapi biar ga ilang
    sendBtn.style.pointerEvents = "none"; // ga bisa diklik
    sendBtn.style.opacity = 0.6; // kasih efek disable, tapi tetap keliatan

    let remaining = cooldown;
    timerDisplay.textContent = `Wait ${remaining}s before resend`;

    const interval = setInterval(() => {
        remaining--;
        timerDisplay.textContent = `Wait ${remaining}s before resend`;

        if (remaining <= 0) {
            clearInterval(interval);
            timerDisplay.textContent = "";
            sendBtn.style.pointerEvents = "auto";
            sendBtn.style.opacity = 1; // balik normal
        }
    }, 1000);

    console.log("Reset link dikirim ke:", emailInput.value);
});
