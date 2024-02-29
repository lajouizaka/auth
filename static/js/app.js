// Parse cookies to an array of key,val pairs
const cookies = document.cookie.split(';').map((str) => ({
  key: str.split('=')[0].trim(),
  val: str.split('=')[1].trim(),
}));

const language = cookies.filter(({ key }) => key === 'language')[0].val;

/**
 * Random Data For Fun!
 */
function randomizer() {
  var randomElements = document.querySelectorAll('.random');
  randomElements.forEach(function (element) {
    element.addEventListener('click', function () {
      switch (this.getAttribute('data-id')) {
        case '1':
          document.querySelector('input[name=title]').value = 'Jacket';
          document.querySelector('input[name=description]').value =
            'Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh. In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.';
          document.querySelector('input[name=cost]').value = '85';
          document.querySelector('input[name=price]').value = '105';
          document.querySelector('input[name=stock]').value = '90';
          break;
        case '2':
          document.querySelector('input[name=title]').value = 'Crackers - Trio';
          document.querySelector('input[name=description]').value =
            'Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.';
          document.querySelector('input[name=cost]').value = '68';
          document.querySelector('input[name=price]').value = '85';
          document.querySelector('input[name=stock]').value = '20';
          break;
        case '3':
          document.querySelector('input[name=title]').value =
            'Turkey Leg With Drum And Thigh';
          document.querySelector('input[name=description]').value =
            'In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus. Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi. Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque. Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.';
          document.querySelector('input[name=cost]').value = '75';
          document.querySelector('input[name=price]').value = '125';
          document.querySelector('input[name=stock]').value = '30';
          break;
        case '4':
          document.querySelector('input[name=title]').value =
            'Squash - Butternut';
          document.querySelector('input[name=description]').value =
            'Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum. Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.';
          document.querySelector('input[name=cost]').value = '25';
          document.querySelector('input[name=price]').value = '65';
          document.querySelector('input[name=stock]').value = '40';
          break;
        default:
          break;
      }
    });
  });

  var randomStoreElements = document.querySelectorAll('.random-store');
  randomStoreElements.forEach(function (element) {
    element.addEventListener('click', function () {
      var stores = ['another store', 'electronics store'];
      document.querySelector('input[name=name]').value =
        stores[Math.floor(Math.random() * stores.length)];
    });
  });

  var randomCategoryElements = document.querySelectorAll('.random-category');
  randomCategoryElements.forEach(function (element) {
    element.addEventListener('click', function () {
      var categories = ['Games', 'PCs'];
      document.querySelector('input[name=name]').value =
        categories[Math.floor(Math.random() * categories.length)];
    });
  });

  var randomUserElements = document.querySelectorAll('.random-user');
  randomUserElements.forEach(function (element) {
    element.addEventListener('click', function () {
      document.querySelector('input[name=full_name]').value = 'First User';
      document.querySelector('input[name=username]').value = 'firstUser';
      document.querySelector('input[name=email]').value = 'first@user.com';
      document.querySelector('input[name=password]').value = '1234';
      document.querySelector('input[name=confirm_password]').value = '1234';
    });
  });
}
randomizer();

function postFormData(element, { url, successCallback }) {
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
        .catch(console.log);
    };
  }
}

const deleteProductForms = document.querySelectorAll('.delete-product-form');

if (deleteProductForms.length) {
  deleteProductForms.forEach((form) => {
    postFormData(form, {
      url: '/admin/products',
      successCallback: (data) => {
        console.log(data);
        if (data.deleted) {
          location.assign('/admin/products');
        }
      },
    });
  });
}

postFormData('addCategoryForm', {
  url: '/admin/categories',
  method: 'POST',
  successCallback: function (data) {
    console.log(data);
  },
});

/**
 * Account Management
 */
postFormData('addUserForm', {
  url: '/admin/account',
  successCallback: addUserSuccess,
});

postFormData('sendValidationEmailForm', {
  url: '/admin/mail_verification',
  successCallback: sendValidationEmailSuccess,
});

postFormData('accountDeletion', {
  url: '/admin/account/delete',
  successCallback: accountDeletionSuccess,
});

postFormData('passwordResetRequestForm', {
  url: '/admin/change-password/request',
  successCallback: passwordResetRequestSuccess,
});

postFormData('passwordResetForm', {
  url: '/admin/change-password',
  successCallback: passwordResetSuccess,
});

function passwordResetSuccess(data) {
  console.log(data);
  if (data.redirect) {
    location.assign(data.redirect);
  }
}

function passwordResetRequestSuccess(data) {
  console.log(data);
  if (data.redirect) {
    location.assign(data.redirect);
  }
}

function accountDeletionSuccess(data) {
  if (data.redirect) {
    location.assign(data.redirect);
  }
}

function sendValidationEmailSuccess(data) {
  console.log(data);
}

function addUserSuccess(data) {
  console.log(data);
}

/**
 * Product
 */
postFormData('addProductForm', {
  url: '/admin/products',
  successCallback: function (data) {
    console.log(data);
  },
  errorCallback: console.error,
});
