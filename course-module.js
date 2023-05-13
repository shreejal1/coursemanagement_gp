// Waiting for the DOM to load
document.addEventListener('DOMContentLoaded', function() {

    // Geting a reference to the select element for the course
const courseSelect = document.getElementById('course');

// Getting a reference to the div that will contain the checkboxes
const moduleCheckboxes = document.getElementById('moduleCheckboxes');

// Addgin an event listener to the course select element
courseSelect.addEventListener('change', (event) => {
  // Geting the selected course ID
  const courseId = event.target.value;

  // Sending a GET request to the PHP script that returns the modules for the selected course
  fetch(`get_module.php?id=${courseId}`)
    .then(response => response.json())
    .then(modules => {
      // Clearing any existing checkboxes
      moduleCheckboxes.innerHTML = '';

      // Createing a checkbox for each module
      modules.forEach(module => {
        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'modules[]';
        checkbox.value = module.id;

        const label = document.createElement('label');
        label.innerHTML = module.name;

        const div = document.createElement('div');
        div.appendChild(checkbox);
        div.appendChild(label);

        moduleCheckboxes.appendChild(div);
      });
    })
    .catch(error => console.error(error));
});

  });
  