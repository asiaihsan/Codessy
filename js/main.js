// Mobile menu toggle
const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('.nav-links');

if (menuToggle && navLinks) {
    menuToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
}


// for the run.php page
function refresh(){
    let editor_value = document.getElementById('editor_textarea').value;
    let output = document.getElementById('output_iframe');
    output.contentDocument.body.innerHTML = editor_value;
}
 