document.getElementById("profile-image").addEventListener("click", function() {
    var profileLinks = document.getElementById("profile-links");
    if (profileLinks.style.display === "none") {
        profileLinks.style.display = "block";
    } else {
        profileLinks.style.display = "none";
    }
});

function updateHeader() {
    document.getElementById("profile-image").style.display = "inline"; 
}
updateHeader();
