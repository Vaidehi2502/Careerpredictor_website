
function startJourney(event) {
    event.preventDefault(); 
  
    let username = document.getElementById("username").value;
  
    if (username.trim() === "") {
      alert("Please enter your name to proceed.");
      return;
    }
  
    
    document.querySelector('form').submit();  
  }
  
  
  function showSection(sectionId) {
    const sections = document.querySelectorAll('section');
    sections.forEach(sec => sec.classList.remove('active'));
    document.getElementById(sectionId).classList.add('active');
  }
  
  
  function handleJobRolesAndCompanies() {
    
    const skills = document.getElementById('skills').value;
    const cgpa = document.getElementById('cgpa').value;
  
    
  }
  