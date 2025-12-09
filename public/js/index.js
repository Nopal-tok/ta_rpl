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
