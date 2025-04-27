<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="CSS/index_style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
</head>
<body>
    <header>
      <nav class="navbar">
          <a href="#" class="logo">
              <img src="Images/emelogo.webp" alt="InternMatch Logo">
          </a>
          <ul class="menu-links">
              <li><a href="#">Home</a></li>
              
              <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'intern'): ?>
                  <li><a href="HTML/post_job.html">Look for a Job</a></li>
              <?php else: ?>
                  <li><a href="HTML/search_page.html">Jobs</a></li>
              <?php endif; ?>

              <?php if (isset($_SESSION['email'])): ?>
                  <li><a href="HTML/userprofile.html">Profile</a></li>
                  <li class="join-btn">
                      <a href="PHP/logout.php" onclick="return confirm('Are you sure you want to log out?')">Log Out</a>
                  </li>
              <?php else: ?>
                  <li><a href="HTML/login.html">Sign In</a></li>
                  <li class="join-btn">
                      <a href="HTML/login.html">Register Now</a>
                  </li>
              <?php endif; ?>
              
              <span id="close-menu-btn" class="material-symbols-outlined">close</span>
          </ul>
          <span id="hamburger-btn" class="material-symbols-outlined">menu</span>
      </nav>
    </header>
    <section class="body-section">
        <div class="content">
          <h1>Search, Tap and Connect with opportunities instantly.</h1>
          <form action="HTML/search_page.html" method="GET" class="search-form">
            <input id="searchInput" name="searchText" type="text" placeholder="Search for applicants or available work..." required>
            <button class="material-symbols-outlined" type="submit">search</button>
          </form>                   
          <div class="popular-tags">
            Search Filter Tags:
            <ul class="tags">
                <li><a href="#">Companies</a></li>
                <li><a href="#">Internship</a></li>
                <li><a href="#">Fresh Graduates</a></li>
              </ul>
          </div>
        </div>
      </section>
      <script>
        const header = document.querySelector("header");
        const hamburgerBtn = document.querySelector("#hamburger-btn");
        const closeMenuBtn = document.querySelector("#close-menu-btn");
        hamburgerBtn.addEventListener("click", () => header.classList.toggle("show-mobile-menu"));
        closeMenuBtn.addEventListener("click", () => hamburgerBtn.click());
      </script>
      <script>
        const input = document.getElementById("searchInput");
        const tags = document.querySelectorAll(".tags a");
      
        tags.forEach(tag => {
          tag.onclick = () => {
            const text = tag.textContent;
            let terms = input.value.split(", ").filter(t => t);
            if (tag.classList.contains("tag-active")) {
              terms = terms.filter(t => t !== text);
              tag.classList.remove("tag-active");
            } else {
              terms.push(text);
              tag.classList.add("tag-active");
            }
            input.value = terms.join(", ");
          };
        });
      </script>     
</body>
</html>