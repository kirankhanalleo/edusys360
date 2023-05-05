const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

// Show Sidebar
menuBtn.addEventListener("click", () => {
    sideMenu.style.display = "block";
});

//Hide Sidebar
closeBtn.addEventListener("click", () => {
    sideMenu.style.display = "none";
});

//Change Theme
themeToggler.addEventListener("click", () => {
    document.body.classList.toggle("dark-theme-variables");

    themeToggler.querySelector("span:nth-child(1)").classList.toggle("active");
    themeToggler.querySelector("span:nth-child(2)").classList.toggle("active");
});
// SearchBar
const searchBar = () => {
    let filter = document.getElementById("search-input").value.toUpperCase();
    let dataTable = document.getElementById("data-table");
    let tr = dataTable.getElementsByTagName("tr");

    for (var i = 0; i < tr.length; i++) {
        let td =
            tr[i].getElementsByTagName("td")[1] ||
            tr[i].getElementsByTagName("td")[2];

        if (td) {
            let textValue = td.textContent || td.innerHTML;

            if (textValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
};
// SearchBar for user
const userSearchBar = () => {
    let filter = document.getElementById("search-input").value.toUpperCase();
    let dataTable = document.getElementById("user-table");
    let tr = dataTable.getElementsByTagName("tr");

    for (var i = 0; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName("td")[3];

        if (td) {
            let textValue = td.textContent || td.innerHTML;

            if (textValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
};

//Modal ShowHide
const openModalButtons = document.querySelectorAll("[data-modal-target]");
const closeModalButtons = document.querySelectorAll("[data-close-button]");
const overlay = document.getElementById("overlay");
openModalButtons.forEach((button) => {
    button.addEventListener("click", () => {
        const modal = document.querySelector(button.dataset.modalTarget);
        openModal(modal);
    });
});

closeModalButtons.forEach((button) => {
    button.addEventListener("click", () => {
        const modal = button.closest(".modal-box");
        closeModal(modal);
    });
});

overlay.addEventListener("click", () => {
    const modals = document.querySelectorAll(".modal-box.active");
    modals.forEach((modal) => {
        closeModal(modal);
    });
});

function openModal(modal) {
    if (modal == null) return;
    modal.classList.add("active");
    overlay.classList.add("active");
}
function closeModal(modal) {
    if (modal == null) return;
    modal.classList.remove("active");
    overlay.classList.remove("active");
}

// Profile Menu Toggle
let profileMenu = document.getElementById("profile-menu");
function toggleMenu() {
    profileMenu.classList.toggle("open-menu");
}
