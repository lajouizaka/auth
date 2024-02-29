const rand = document.getElementById('rand');

if (rand) {
  rand.onclick = function (ev) {
    document
      .querySelector('input[name="email"]')
      .setAttribute('value', 'lajouizakariae@gmail.com');
    document
      .querySelector('input[name="password"]')
      .setAttribute('value', '12345');
  };
}
/**
 * App
 */
function postFormData(element, { url, successCallback, errorCallback }) {
  const form =
    typeof element === 'string' ? document.getElementById(element) : element;

  if (form) {
    form.onsubmit = (ev) => {
      ev.preventDefault();

      const data = new FormData(ev.target);

      data.append(
        'csrf_token',
        document
          .querySelector('meta[name="csrf_token"]')
          .getAttribute('content')
      );

      fetch(url, {
        method: 'POST',
        headers: {
          Accept: 'application/json',
        },
        body: data,
      })
        .then((req) => req.json())
        .then(successCallback)
        .catch(errorCallback);
    };
  }
}

postFormData('loginForm', {
  url: '/admin/login',
  successCallback: loginSuccess,
  errorCallback: console.log,
});

postFormData('registerForm', {
  url: '/admin/register',
  errorCallback: console.log,
  successCallback: registerSuccess,
});

// Request Handlers
function loginSuccess(data) {
  if (data.loggedIn) {
    location.assign(data.redirect);
  }

  console.log(data);
}

function registerSuccess(data) {
  console.log(data);
  if (data.loggedIn) {
    location.assign(data.redirect);
  }
}
