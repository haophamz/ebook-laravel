/* ===========================
   Password Strength Meter
=========================== */
const pwInput = document.getElementById('pw');
const bars = document.querySelectorAll('#strengthBars .bar');
const strengthColors = [
  '#e24b4a', // 1 — rất yếu
  '#e24b4a', // 2 — yếu
  '#f0993b', // 3 — trung bình
  '#f0993b', // 4 — khá
  '#63a022', // 5 — mạnh
  '#1d9e75', // 6 — rất mạnh
];

pwInput.addEventListener('input', () => {
  const v = pwInput.value;
  let score = 0;

  if (v.length >= 8)            score++;
  if (v.length >= 12)           score++;
  if (/[A-Z]/.test(v))         score++;
  if (/[0-9]/.test(v))         score++;
  if (/[^A-Za-z0-9]/.test(v))  score++;

  bars.forEach((bar, i) => {
    bar.style.background = i < score
      ? strengthColors[Math.max(0, score - 1)]
      : '#eee';
  });
});

/* ===========================
   Toggle Show / Hide Password
=========================== */
document.getElementById('togglePw').addEventListener('click', () => {
  const isPassword = pwInput.type === 'password';
  pwInput.type = isPassword ? 'text' : 'password';
  document.getElementById('eyeIcon').className = isPassword
    ? 'ti ti-eye'
    : 'ti ti-eye-off';
});

/* ===========================
   Shake helper
=========================== */
function shakeElement(id) {
  const el = document.getElementById(id);
  el.classList.remove('shake');
  void el.offsetWidth; // reflow để restart animation
  el.classList.add('shake');
  el.addEventListener('animationend', () => el.classList.remove('shake'), { once: true });
}

/* ===========================
   Form Validation & Submit
=========================== */
document.getElementById('createBtn').addEventListener('click', () => {
  const email    = document.getElementById('email').value.trim();
  const password = pwInput.value;
  const fname    = document.getElementById('fname').value.trim();
  const lname    = document.getElementById('lname').value.trim();
  const tos      = document.getElementById('tos').checked;

  // Validate email
  if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    shakeElement('emailWrap');
    document.getElementById('email').focus();
    return;
  }

  // Validate password
  if (!password || password.length < 8) {
    shakeElement('pwWrap');
    pwInput.focus();
    return;
  }

  // Validate ToS
  if (!tos) {
    document.getElementById('tos').focus();
    alert('Vui lòng đồng ý với Terms of Service và Privacy Policy.');
    return;
  }

  // TODO: gọi API hoặc submit form ở đây
  alert(`Tạo tài khoản thành công!\nEmail: ${email}\nTên: ${fname} ${lname}`.trim());
});