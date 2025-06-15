console.log("JS cargado");

const steps = document.querySelectorAll('.step');
const forms = document.querySelectorAll('.step-form');
const nextBtn = document.getElementById('nextBtn');
const prevBtn = document.getElementById('prevBtn');
const form = document.getElementById('formSteps');

let current = 0;

function showStep(index) {
  forms.forEach((formStep, i) => {
    formStep.classList.toggle('step-form-active', i === index);
  });

  if (steps.length > 0) {
    steps.forEach((step, i) => {
      step.classList.remove('active', 'completed');
      if (i < index) step.classList.add('completed');
      else if (i === index) step.classList.add('active');
    });
  }

  prevBtn.style.display = index > 0 ? 'inline-block' : 'none';
  nextBtn.textContent = index === forms.length - 1 ? 'Submit' : 'Next';
}

nextBtn.addEventListener('click', () => {
  const currentFormFields = forms[current].querySelectorAll('input, select, textarea');
  let allValid = true;

  currentFormFields.forEach(field => {
    if (!field.checkValidity()) {
      allValid = false;
      field.reportValidity(); // solo muestra el primero que falla
      return;
    }
  });

  if (!allValid) return;

  if (current < forms.length - 1) {
    current++;
    showStep(current);
  } else {
  document.getElementById('submitBtn').click();

  }
});

prevBtn.addEventListener('click', () => {
  if (current > 0) {
    current--;
    showStep(current);
  }
});

document.addEventListener("DOMContentLoaded", () => {
  showStep(current);
});