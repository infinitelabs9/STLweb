console.log("JS cargado");

const steps = document.querySelectorAll('.step');
const forms = document.querySelectorAll('.step-form');
const nextBtn = document.getElementById('nextBtn');
const prevBtn = document.getElementById('prevBtn');

let current = 0;

function showStep(index) {
  forms.forEach((form, i) => {
    form.classList.toggle('step-form-active', i === index);
  });

  steps.forEach((step, i) => {
    step.classList.remove('active', 'completed');
    if (i < index) step.classList.add('completed');
    else if (i === index) step.classList.add('active');
  });

  prevBtn.style.display = index > 0 ? 'inline-block' : 'none';
  nextBtn.textContent = index === steps.length - 1 ? 'Submit' : 'Next';
}

nextBtn.addEventListener('click', () => {
  if (current < steps.length - 1) {
    current++;
    showStep(current);
  } else {
    document.getElementById('formSteps').submit();
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
