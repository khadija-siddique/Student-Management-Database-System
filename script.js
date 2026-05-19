// ─── PHONE VALIDATION ───────────────────────────────────────────────
document.getElementById('phone').addEventListener('input', function () {
  this.value = this.value.replace(/[^0-9]/g, '');
  if (this.value.length > 11) this.value = this.value.slice(0, 11);
});

// ─── CNIC (last 4 digits only) ──────────────────────────────────────
document.getElementById('cnic').addEventListener('input', function () {
  this.value = this.value.replace(/[^0-9]/g, '');
});

// ─── ROLL NUMBER FORMAT HINT ─────────────────────────────────────────
document.getElementById('rollno').addEventListener('blur', function () {
  const pattern = /^\d{4}-[A-Z]+-\d{3}$/;
  if (this.value && !pattern.test(this.value)) {
    this.style.border = '2px solid red';
    this.title = 'Format should be like: 2024-CS-001';
  } else {
    this.style.border = '';
    this.title = '';
  }
});

// ─── MARKS: show percentage live ─────────────────────────────────────
document.getElementById('marks').addEventListener('input', function () {
  const val = parseInt(this.value);
  let hint = document.getElementById('marks-hint');

  if (!hint) {
    hint = document.createElement('small');
    hint.id = 'marks-hint';
    hint.style.color = '#58d68d';
    hint.style.display = 'block';
    hint.style.marginTop = '-8px';
    hint.style.marginBottom = '8px';
    this.insertAdjacentElement('afterend', hint);
  }

  if (!isNaN(val) && val >= 0 && val <= 1100) {
    const pct = ((val / 1100) * 100).toFixed(1);
    let grade = '';
    if (pct >= 80) grade = '🏆 A+';
    else if (pct >= 70) grade = '🥇 A';
    else if (pct >= 60) grade = '🥈 B';
    else if (pct >= 50) grade = '🥉 C';
    else grade = '❌ Fail';
    hint.textContent = `📊 ${pct}% — ${grade}`;
  } else {
    hint.textContent = '';
  }
});

// ─── DEPARTMENT → auto-suggest roll number prefix ────────────────────
document.getElementById('department').addEventListener('change', function () {
  const map = {
    'Computer Science':       'CS',
    'Software Engineering':   'SE',
    'Information Technology': 'IT',
    'Electrical Engineering': 'EE',
    'Mechanical Engineering': 'ME',
    'Business Administration':'BA',
  };
  const rollInput = document.getElementById('rollno');
  const prefix = map[this.value];
  if (prefix && !rollInput.value) {
    const year = new Date().getFullYear();
    rollInput.placeholder = `e.g. ${year}-${prefix}-001`;
  }
});

// ─── FORM SUBMIT: final validation & confirm ─────────────────────────
document.querySelector('form').addEventListener('submit', function (e) {
  const phone = document.getElementById('phone').value;
  const cnic  = document.getElementById('cnic').value;
  const marks = parseInt(document.getElementById('marks').value);

  // Phone must be exactly 11 digits starting with 03
  if (!/^03[0-9]{9}$/.test(phone)) {
    e.preventDefault();
    alert('⚠️ Phone must be 11 digits and start with 03 (e.g. 03001234567)');
    document.getElementById('phone').focus();
    return;
  }

  // CNIC last 4 digits
  if (!/^[0-9]{4}$/.test(cnic)) {
    e.preventDefault();
    alert('⚠️ Please enter exactly 4 digits for CNIC.');
    document.getElementById('cnic').focus();
    return;
  }

  // Marks range
  if (isNaN(marks) || marks < 0 || marks > 1100) {
    e.preventDefault();
    alert('⚠️ Marks must be between 0 and 1100.');
    document.getElementById('marks').focus();
    return;
  }
});

// ─── RESET: clear dynamic hints ──────────────────────────────────────
document.querySelector('button[type="reset"]').addEventListener('click', function () {
  const hint = document.getElementById('marks-hint');
  if (hint) hint.textContent = '';
  document.getElementById('rollno').style.border = '';
});