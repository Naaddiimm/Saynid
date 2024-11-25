

function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => {
        section.classList.toggle('active', section.id === sectionId);
    });
}


function confirmDelete() {
    return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');
}

function toggleForm() {
    const formContainer = document.getElementById('formContainer');
    formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
}

function validateForm() {
    const titre = document.getElementById('titre').value.trim();
    const description = document.getElementById('description').value.trim();
    const errorMessage = document.getElementById('errorMessage');
    const errorMessage2 = document.getElementById('errorMessage2');

    // Effacer les messages d'erreur précédents
    errorMessage.textContent = '';
    errorMessage2.textContent = '';

    if (titre === '' && description === '') {
        errorMessage.textContent = 'Veuillez entrer votre titre de cours.';
        errorMessage2.textContent = 'Veuillez entrer votre description.';
        return false;
    }

    if (titre === '') {
        errorMessage.textContent = 'Veuillez entrer votre titre de cours.';
        return false;
    }

    if (description === '') {
        errorMessage2.textContent = 'Veuillez entrer votre description.';
        return false;
    }

    return true;
}