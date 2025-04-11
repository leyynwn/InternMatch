let job_posts = [
    {
        title: "Virtual Assistant",
        company: "Jay Raw",
        employment: "Full Time",
        salary: "Up to $1500",
        description: "Now Hiring: General Virtual Assistant...",
        skills: ["Administrative Management", "Communication", "Notion"]
    },
    {
        title: "Graphic Designer",
        company: "DesignCo",
        employment: "Part-Time",
        salary: "Up to $800",
        description: "Looking for a creative graphic designer to join our team.",
        skills: ["Design", "Photoshop", "Illustrator"]
    },
    {
        title: "Web Developer",
        company: "Tech Ventures",
        employment: "Full-Time",
        salary: "Up to $2000",
        description: "Join our team as a Web Developer and help build cutting-edge websites.",
        skills: ["JavaScript", "HTML", "CSS"]
    },
    {
        title: "Data Scientist",
        company: "DataCo",
        employment: "Full-Time",
        salary: "Up to $3000",
        description: "Seeking an experienced data scientist to analyze large datasets.",
        skills: ["Python", "Machine Learning", "Statistics"]
    },
    {
        title: "SEO Specialist",
        company: "SEO Experts",
        employment: "Part-Time",
        salary: "Up to $1200",
        description: "We are looking for an SEO expert to optimize our website for search engines.",
        skills: ["SEO", "Content Marketing", "Google Analytics"]
    }
];

let nav = document.querySelector("nav"); //Nav Bar animation
window.onscroll = function() {

  if(document.documentElement.scrollTop > 20){
      nav.classList.add("dynamicnav");
  } else {
      nav.classList.remove("dynamicnav");
  }
}

const params = new URLSearchParams(window.location.search); //Search Bar Input-Output
const searchText = params.get("searchText");

  if (searchText) {
    document.querySelector(".search-form input").value = searchText;
  }


// Function to display posts
const displayPost = (posts) => {
    const jobList = document.getElementById('jobList');
    jobList.innerHTML = posts.map(post => {
        const { title, company, employment, salary, description, skills } = post;
        return `
            <div class="job-card">
                <h3>${title} <span class="job-badge">${employment}</span></h3>
                <p><strong>${company}</strong> • <i>Posted on Apr 03, 2025</i></p>
                <p>${salary}</p>
                <p>${description}</p>
                <div class="tags">
                    ${skills.map(skill => `<span>${skill}</span>`).join('')}
                </div>
            </div>
        `;
    }).join('');
};

// Listen for keyup in the search bar
document.querySelector('.search-form input').addEventListener('keyup', (e) => {
    const searchData = e.target.value.toLowerCase();
    const filterData = job_posts.filter(post =>
        post.title.toLowerCase().includes(searchData)
    );
    displayPost(filterData);
});

// Display all posts initially
displayPost(job_posts);
