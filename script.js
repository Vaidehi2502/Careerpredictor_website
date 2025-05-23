document.addEventListener('DOMContentLoaded', function () {
  const jobs = {
    "Data Scientist": ["Python", "Data Analysis", "Machine Learning", "SQL"],
    "Web Developer (Front-end)": ["HTML", "CSS", "JavaScript"],
    "Web Developer (Back-end)": ["Python", "PHP", "Databases", "APIs"],
    "Software Engineer": ["Python", "Java", "C++", "Algorithms"],
    "Machine Learning Engineer": ["Python", "TensorFlow", "Machine Learning"],
    "UI/UX Designer": ["Figma", "Prototyping", "HTML"],
    "Cybersecurity Analyst": ["Python", "Network Security", "Ethical Hacking"]
  };

  const input = document.getElementById('skillInput');
  const jobList = document.getElementById('jobList');

  input.addEventListener('input', () => {
    const skill = input.value.trim().toLowerCase();
    jobList.innerHTML = '';

    if (skill === '') return;

    const matchedJobs = Object.entries(jobs).filter(([job, skills]) =>
      skills.some(s => s.toLowerCase().includes(skill))
    );

    if (matchedJobs.length === 0) {
      jobList.innerHTML = '<li>No jobs found with that skill.</li>';
      return;
    }

    matchedJobs.forEach(([job]) => {
      const li = document.createElement('li');
      li.textContent = job;
      jobList.appendChild(li);
    });
  });
});
