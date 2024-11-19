// Initialisation des variables nadim  
let cart = [];
let totalPrice = 0;

// Afficher la section active
function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => section.classList.remove('active'));
    const activeSection = document.getElementById(sectionId);
    if (activeSection) activeSection.classList.add('active');
}

// Ajouter un cours au panier
function addToCart(courseId, courseName, coursePrice) {
    const courseExists = cart.some(item => item.id === courseId);
    if (courseExists) {
        alert("Ce cours est déjà dans le panier.");
        return;
    }

    cart.push({ id: courseId, name: courseName, price: coursePrice });
    totalPrice += coursePrice;
    updateCartDetails();
    document.getElementById('cart-details').style.display = 'block';
}

// Mettre à jour les détails du panier
function updateCartDetails() {
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = '';

    cart.forEach((item) => {
        const listItem = document.createElement('li');
        listItem.textContent = `${item.name} : €${item.price}`;
        cartItemsContainer.appendChild(listItem);
    });

    document.getElementById('total-price').textContent = `Prix Total: €${totalPrice}`;
}

// Soumettre le formulaire d'achat
function submitCartForm() {
    const courseTitleInput = document.getElementById('courseTitle');
    const courseIdInput = document.getElementById('courseId');

    if (cart.length === 0) {
        alert("Votre panier est vide.");
        return;
    }

    const cardNumber = document.getElementById('card-number').value;
    if (cardNumber === '') {
        alert("Veuillez entrer votre numéro de carte.");
        return;
    }

    cart.forEach((item) => {
        courseTitleInput.value = item.name;
        courseIdInput.value = item.id; // Remplir l'ID du cours dans le formulaire
        document.getElementById('purchaseForm').submit();
    });

    alert("Tous les achats ont été enregistrés.");
    clearCart();
}

// Supprimer les cours sélectionnés du panier
function removeSelectedCourses() {
    const checkboxes = document.querySelectorAll('.course-checkbox');
    checkboxes.forEach((checkbox, index) => {
        if (checkbox.checked) {
            totalPrice -= cart[index].price;
            cart.splice(index, 1);
        }
    });

    updateCartDetails();
    if (cart.length === 0) document.getElementById('cart-details').style.display = 'none';
}

// Vider le panier
function clearCart() {
    cart = [];
    totalPrice = 0;
    document.getElementById('card-number').value = '';
    updateCartDetails();
    document.getElementById('cart-details').style.display = 'none';
}

// Afficher la section des cours par défaut lors du chargement de la page
document.addEventListener("DOMContentLoaded", () => {
    showSection('cours');
});
