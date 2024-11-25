
// Afficher la section active
function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => section.classList.remove('active'));
    
    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
        activeSection.classList.add('active');
    }

    // Défilement vers la section
    activeSection.scrollIntoView({ behavior: "smooth" });
}

// Vérifier si l'ancre est présente et afficher la section correspondante
document.addEventListener("DOMContentLoaded", () => {
    const hash = window.location.hash; // Récupérer l'ancre dans l'URL

    if (hash === "#Profile") {
        showSection('Profile');  // Afficher la section "Profile" si l'ancre est présente
    } else {
        showSection('cours');  // Sinon, afficher la section des cours par défaut
    }
});

 // Optionnel: scroll vers la section Profile si la page se recharge
 if (window.location.hash === "#Profile") {
    document.getElementById("Profile").scrollIntoView({ behavior: "smooth" });
}

document.querySelector('form').addEventListener('submit', function (event) {
    let hasError = false;

    // Effacer les messages d'erreur précédents
    document.querySelectorAll('.error-message').forEach(function (el) {
        el.textContent = '';
    });

    // Validation des champs
    const oldPassword = document.getElementById('oldPassword');
    const newPassword = document.getElementById('newPassword');
    const confirmNewPassword = document.getElementById('confirmNewPassword');
    
    if (oldPassword.value.trim() === '') {
        document.getElementById('oldPasswordError').textContent = 'Ancien mot de passe requis';
        hasError = true;
    }

    if (newPassword.value.trim() === '') {
        document.getElementById('newPasswordError').textContent = 'Nouveau mot de passe requis';
        hasError = true;
    }

    if (confirmNewPassword.value.trim() === '') {
        document.getElementById('confirmNewPasswordError').textContent = 'Confirmer le mot de passe requis';
        hasError = true;
    }

    if (newPassword.value !== confirmNewPassword.value) {
        document.getElementById('confirmNewPasswordError').textContent = 'Les mots de passe ne correspondent pas';
        hasError = true;
    }

    if (hasError) {
        event.preventDefault(); // Empêcher l'envoi du formulaire en cas d'erreur
    }
});

