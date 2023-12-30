<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Строительный интернет магазин</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('icon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('icon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('icon/favicon-16x16.png')}}">
    <link rel="mask-icon" href="{{asset('icon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="preload" href="{{asset('fonts/nunito-v26-cyrillic_latin-600.woff2')}}" as="font" crossorigin>
    <link rel="preload" href="{{asset('fonts/nunito-v26-cyrillic_latin-800.woff2')}}" as="font" crossorigin>
    <link rel="preload" href="{{asset('fonts/nunito-v26-cyrillic_latin-regular.woff2')}}" as="font" crossorigin>
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
</head>
<body>

<header class="header">
    <div class="container header__container">
        <div class="header__title-container">
            <h1 class="header__title">
                <span class="header__title-text">Только самые</span>
                <span class="header__title-text header__title-text_red">сочные инструменты!</span>
            </h1>

            <p class="header__appeal">Бесплатная доставка от 599TJS</p>
        </div>
    </div>
</header>

<main>
    <nav class="navigation">
        <div class="container navigation__container">
            <ul class="navigation__list" >
                @foreach($categories as $category)
                  <li class="navigation__item" style="cursor: pointer; margin-bottom: 6px;">
                    <a href="{{ route('category', ['id' => $category->id]) }}">
                      <button class="navigation__button" id="navigation_button{{$category->id}}">
                        {{ $category->name }}
                      </button>
                    </a>
                  </li>
                @endforeach
            </ul>
        </div>
    </nav>

    <section class="catalog">
        <div class="container catalog__container">
            <div class="catalog__order order">
                <section class="order__wrapper open_order">
                    <div class="order__wrap-title" tabindex="0" role="button" onclick="showOrderList()">
                        <h2 class="order__title">Корзина</h2>

                        <span class="order__count" id="order_count">0</span>
                    </div>

                    <div class="order__wrap_list" id="order_list" style="display: none">
                        <ul class="order__list" id="basket">

                        </ul>

                        <div class="order__total">
                            <p>Итого</p>
                            <p>
                                <span class="order__total-amount" id="order_total">0</span>
                                <span class="currency">TJS</span>
                            </p>
                        </div>

                        <button class="order__submit" onclick="showModalOrder()">Оформить заказ</button>

                        <div class="order__wrap-appeal">
                            <p class="order__appeal">Бесплатная доставка</p>
                        </div>
                    </div>

                    <div id="order_empty" >
                      <span style="font-size: 12px;">В корзине пока пусто!</span>
                    </div>

                </section>
            </div>

            <div class="catalog__wrapper">
              <div style="display: flex;align-items: center">
                <h2 class="catalog__title" id="catalog_title">Все товары</h2>
                <form method="post" action="{{ route('filter', ['sort' => 'desc']) }}">
                  @csrf
                  <button class="filter" >Сначала дорогие</button>
                </form>
                <form method="post" action="{{ route('filter', ['sort' => 'asc']) }}">
                  @csrf
                  <button class="filter" >Сначала дешёвые</button>
                </form>
              </div>


                <div class="catalog__wrap_list">
                    <ul class="catalog__list">
                        @foreach($goods as $good)
                        @php
                          $characteristics = [];
                        @endphp
                        @foreach($good->characteristics as $chr)
                          <p style="display: none">{{$chr->characteristics->name}}: {{$chr->value}}</p>
                          @php
                            $characteristics[] = $chr->characteristics->name
                          @endphp
                        @endforeach
                            <li class="catalog__item" style="cursor: pointer" id="showProduct" onclick="showModalProduct({{$good}}, {{$good->characteristics}}, {{ json_encode($characteristics) }})">
                                <article class="product">
                                    <img src="{{Storage::url($good->img) }}" alt="{{$good->name}}" class="product__image" >

                                    <p class="product__price">{{ $good->price }}<span class="currency">TJS</span></p>

                                    <h3 class="product__title">
                                        <button class="product__detail" id="product_detail">{{ $good->name }}</button>
                                    </h3>


                                    <button class="product__add" type="button"  id="product_add{{$good->id}}">Добавить</button>
                                </article>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="footer">
    <div class="container">
        <div class="footer__content">
            <address class="footer__address">
                <div class="footer__contact">
                    <h2 class="footer__title">Номер для заказа</h2>

                    <a class="footer__link-phone" href="tel: +992928098333">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.01 15.38C18.78 15.38 17.59 15.18 16.48 14.82C16.13 14.7 15.74 14.79 15.47 15.06L13.9 17.03C11.07 15.68 8.42 13.13 7.01 10.2L8.96 8.54C9.23 8.26 9.31 7.87 9.2 7.52C8.83 6.41 8.64 5.22 8.64 3.99C8.64 3.45 8.19 3 7.65 3H4.19C3.65 3 3 3.24 3 3.99C3 13.28 10.73 21 20.01 21C20.72 21 21 20.37 21 19.82V16.37C21 15.83 20.55 15.38 20.01 15.38Z"/>
                        </svg>

                        <span>+992-(92)-809-83-33</span>
                    </a>
                </div>

                <div class="footer__contact">
                    <h2 class="footer__title footer__title_sn">Мы в соцсетях</h2>
                    <ul class="footer__list">
                        <li class="footer__list-item">
                            <a href="#" class="footer__link-sn" aria-label="группа в вк">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 0C8.05875 0 0 8.05875 0 18C0 27.9412 8.05875 36 18 36C27.9412 36 36 27.9412 36 18C36 8.05875 27.9412 0 18 0ZM24.9225 20.3081C24.9225 20.3081 26.5144 21.8794 26.9062 22.6087C26.9175 22.6237 26.9231 22.6387 26.9269 22.6462C27.0862 22.9144 27.1237 23.1225 27.045 23.2781C26.9137 23.5369 26.4637 23.6644 26.31 23.6756H23.4975C23.3025 23.6756 22.8937 23.625 22.3987 23.2837C22.0181 23.0175 21.6431 22.5806 21.2775 22.155C20.7319 21.5212 20.2594 20.9738 19.7831 20.9738C19.7226 20.9736 19.6625 20.9831 19.605 21.0019C19.245 21.1181 18.7838 21.6319 18.7838 23.0006C18.7838 23.4281 18.4462 23.6737 18.2081 23.6737H16.92C16.4812 23.6737 14.1956 23.52 12.1706 21.3844C9.69187 18.7687 7.46062 13.5225 7.44187 13.4737C7.30125 13.1344 7.59187 12.9525 7.90875 12.9525H10.7494C11.1281 12.9525 11.2519 13.1831 11.3381 13.3875C11.4394 13.6256 11.8106 14.5725 12.42 15.6375C13.4081 17.3737 14.0138 18.0787 14.4994 18.0787C14.5904 18.0777 14.6799 18.0545 14.76 18.0112C15.3937 17.6587 15.2756 15.3994 15.2475 14.9306C15.2475 14.8425 15.2456 13.92 14.9212 13.4775C14.6887 13.1569 14.2931 13.035 14.0531 12.99C14.1503 12.856 14.2782 12.7473 14.4262 12.6731C14.8612 12.4556 15.645 12.4237 16.4231 12.4237H16.8563C17.7 12.435 17.9175 12.4894 18.2231 12.5662C18.8419 12.7144 18.855 13.1137 18.8006 14.4806C18.7838 14.8687 18.7669 15.3075 18.7669 15.825C18.7669 15.9375 18.7612 16.0575 18.7612 16.185C18.7425 16.8806 18.72 17.67 19.2112 17.9944C19.2753 18.0346 19.3494 18.056 19.425 18.0562C19.5956 18.0562 20.1094 18.0562 21.5006 15.6694C21.9297 14.9011 22.3025 14.1028 22.6162 13.2806C22.6444 13.2319 22.7269 13.0819 22.8244 13.0237C22.8963 12.9871 22.9761 12.9684 23.0569 12.9694H26.3962C26.76 12.9694 27.0094 13.0237 27.0562 13.1644C27.1387 13.3875 27.0412 14.0681 25.5169 16.1325L24.8362 17.0306C23.4544 18.8419 23.4544 18.9338 24.9225 20.3081Z"/>
                                </svg>
                            </a>
                        </li>
                        <li class="footer__list-item">
                            <a href="#" class="footer__link-sn" aria-label="канал в телеграм">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M36 18C36 22.7739 34.1036 27.3523 30.7279 30.7279C27.3523 34.1036 22.7739 36 18 36C13.2261 36 8.64773 34.1036 5.27208 30.7279C1.89642 27.3523 0 22.7739 0 18C0 13.2261 1.89642 8.64773 5.27208 5.27208C8.64773 1.89642 13.2261 0 18 0C22.7739 0 27.3523 1.89642 30.7279 5.27208C34.1036 8.64773 36 13.2261 36 18ZM18.6458 13.2885C16.8952 14.0175 13.3942 15.525 8.14725 17.811C7.29675 18.1485 6.849 18.4815 6.8085 18.8055C6.741 19.3522 7.42725 19.5683 8.361 19.863L8.75475 19.9868C9.67275 20.286 10.9102 20.6348 11.5515 20.6483C12.1365 20.6618 12.7867 20.4233 13.5045 19.9283C18.4072 16.6185 20.9385 14.9467 21.096 14.9107C21.2085 14.8837 21.366 14.8523 21.4695 14.9468C21.5752 15.039 21.564 15.2168 21.5528 15.264C21.4853 15.5542 18.792 18.0562 17.3993 19.3522C16.965 19.7572 16.6567 20.043 16.5938 20.1082C16.455 20.25 16.314 20.3895 16.1707 20.5268C15.3157 21.3503 14.6768 21.9668 16.2045 22.9748C16.9403 23.4608 17.5298 23.859 18.117 24.2595C18.756 24.696 19.395 25.1303 20.223 25.6748C20.4322 25.8098 20.6348 25.956 20.8305 26.0955C21.5753 26.6265 22.248 27.1035 23.0737 27.027C23.5553 26.982 24.0525 26.532 24.3045 25.182C24.9007 21.9938 26.073 15.0885 26.343 12.2423C26.3595 12.0056 26.3497 11.7679 26.3137 11.5335C26.2926 11.3443 26.201 11.17 26.0573 11.0452C25.8525 10.9039 25.6085 10.8307 25.3597 10.836C24.6847 10.8472 23.643 11.2095 18.6458 13.2885Z"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

            </address>

            <div class="footer__development">
                <p>© Строительный интернет-магазин, 2023</p>
                <p>Developer: <a href="">Хайдаров Даврон</a></p>
            </div>
        </div>
    </div>
</footer>

<div id="modal_product" class="modal modal_product "> {{-- modal_open --}}

</div>

<div id="modal_order" class="modal modal_delivery "> <!-- modal_open -->
    <div class="modal__main modal-delivery">
        <div class="modal-delivery__container">
            <h2 class="modal-delivery__title">Доставка</h2>

            <form class="modal-delivery__form" id="delivery">
                <fieldset class="modal-delivery__fieldset">
                    <input class="modal-delivery__input" type="text" name="name" placeholder="Ваше имя" id="form_delivery_name">
                    <input class="modal-delivery__input" type="tel" name="phone" placeholder="Телефон" id="form_delivery_phone">
                </fieldset>

                <fieldset class="modal-delivery__fieldset modal-delivery__fieldset_radio" onchange="deliveryForm(event.target.value)">
                    <label class="modal-delivery__label">
                        <input class="modal-delivery__radio " type="radio" name="delivery" value="Самовывоз">
                        <span>Самовывоз</span>
                    </label>
                    <label class="modal-delivery__label">
                        <input class="modal-delivery__radio" type="radio" name="delivery" value="Доставка" checked>
                        <span>Доставка</span>
                    </label>
                </fieldset>

                <fieldset class="modal-delivery__fieldset" id="delivery_address">
                    <input class="modal-delivery__input" type="text" name="address" placeholder="Адресс" id="form_delivery_address">
                </fieldset>
            </form>

            <button class="modal-delivery__submit" type="button" form="delivery" onclick="makeOrder()">Оформить</button>
        </div>

        <button class="modal__close" onclick="document.getElementById('modal_order').classList.remove('modal_open')">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <rect x="5.07422" y="5.28247" width="1" height="20" transform="rotate(-45 5.07422 5.28247)"/>
                <rect x="5.78125" y="19.4246" width="1" height="20" transform="rotate(-135 5.78125 19.4246)"/>
            </svg>
        </button>
    </div>
</div>
<script>
  let carts = [];
  let goods = @json($goods);
  let categories =  @json($categories);

  let cartsInLocalStorage = JSON.parse(localStorage.getItem('carts')) || [];
  carts = carts.concat(cartsInLocalStorage);

  let id = window.location.pathname[window.location.pathname.length - 1];

  function existsProductOnCart() {
    const productId = []
    goods.forEach(good => {
      productId.push(good.id)
    });
    cartsInLocalStorage.forEach(item => {
      productId.forEach(id => {
        if (item.id === id) {
          const addButton = document.getElementById(`product_add${id}`);

          if (cartsInLocalStorage && cartsInLocalStorage.length > 0) {
            addButton.innerText = 'В корзине';
          } else {
            addButton.innerText = 'Добавить';
          }
        }
      })
    });

  }
  existsProductOnCart()

  const foundCategory = categories.find(category => {
   if (category.id === Number(id)) {
     document.getElementById(`navigation_button${category.id}`).classList.add('navigation__button_active')
   }
   return  category.id === Number(id)
  });

  if (foundCategory) {
    document.getElementById('catalog_title').textContent = foundCategory.name
  }


  function showModalProduct(cartData, characteristics, keys) {
    if (cartsInLocalStorage.some(item => item.id == cartData.id)) return;
    document.getElementById('modal_product').classList.add('modal_open')




    const modalProduct = document.getElementById('modal_product')

    characteristics.forEach(chr => console.log(chr))
    const characteristic = document.querySelectorAll('#characteristic')

    modalProduct.innerHTML = `
    <div class="modal__main modal-product">
        <div class="modal-product__container">
            <h2 class="modal-product__title" id="modal_product_title">${cartData.name}</h2>

            <div class="modal-product__content">
                <img src="http://127.0.0.1:8000/storage/${cartData.img}" alt="Мясная бомба" class="modal-product__image">

                <p class="modal-product__description">${cartData.description !== null ? cartData.description : 'Нету описаний'}</p>

                <div class="modal-product__ingredients ingredients">
                    <h3 class="ingredients__title">Характеристика:</h3>

                    <div style="display: flex" id="characteristick">
                     <table>
                       <tr>
                        <td>${keys.map(key => characteristic.textContent = `<p class="ingredients__calories">${key}</p>`).join('')}</td>
                        <td></td>
                        <td></td>
                        <td>${characteristics.map(chr => characteristic.textContent = `<p class="ingredients__calories">${chr.value}</p>`).join('')}</td>
                       </tr>
                     </table>
                    </div>
                </div>

                <div class="modal-product__footer">

                    <div class="modal-product__add">
                        <button class="modal-product__btn" onclick="addToCart(${cartData.id})">Добавить</button>
                    </div>

                </div>
                <p class="modal-product__price">${cartData.price}
                    <span class="currency">TJS</span>
                </p>
            </div>
        </div>

        <button class="modal__close"  onclick="document.getElementById('modal_product').classList.remove('modal_open')">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <rect x="5.07422" y="5.28247" width="1" height="20" transform="rotate(-45 5.07422 5.28247)"/>
                <rect x="5.78125" y="19.4246" width="1" height="20" transform="rotate(-135 5.78125 19.4246)"/>
            </svg>
        </button>
    </div>`


  }


  document.getElementById('order_count').textContent = cartsInLocalStorage.length;



  function addToCart(id) {
    let cartData = goods.find(item => item.id === id);
    cartData.quantity = 1;
    document.getElementById('modal_product').classList.remove('modal_open')

    carts.push(cartData)
    localStorage.setItem('carts', JSON.stringify(carts))
    location.reload()


    getGoodsOfBasket()
  }

  function showBasket() {
    if (cartsInLocalStorage && cartsInLocalStorage.length > 0) {
      document.getElementById('order_empty').setAttribute('style', 'display: none');
      document.getElementById('order_list').setAttribute('style', 'display: block');
    } else {
      document.getElementById('order_list').setAttribute('style', 'display: none');
      document.getElementById('order_empty').setAttribute('style', 'display: block');
    }

  }

  function showOrderList() {
    if (cartsInLocalStorage && cartsInLocalStorage.length > 0) {
      const order_list = document.getElementById('order_list');
      if (order_list.style.display === 'none' || order_list.style.display === '') {
        order_list.style.display = 'block';
      } else {
        order_list.style.display = 'none';
      }
    }
  }

  function totalPrice() {
    const totalPrice = cartsInLocalStorage.reduce((total, cart) => total + cart.price * cart.quantity, 0);
    cartsInLocalStorage.totalPrice = totalPrice;
    document.getElementById('order_total').textContent = totalPrice;
    localStorage.setItem('carts', JSON.stringify(carts));
  }

  getGoodsOfBasket();

  function getGoodsOfBasket() {
    const basket = document.getElementById('basket');

    if (cartsInLocalStorage) {
      basket.innerHTML = cartsInLocalStorage.map(cart =>
        `<li class="order__item">
            <img src="http://127.0.0.1:8000/storage/${cart.img}" alt="${cart.name}" class="order__image" />

            <div class="order__product">
                <h3 class="order__product-title">${cart.name}</h3>
                <p class="order__product-weight"></p>
                <p class="order__product-price">${cart.price}
                    <span class="currency">TJS</span>
                </p>
            </div>

            <div class="order__product-count count">
                <button class="count__minus" onclick="decreaseQuantity(${cart.id})">-</button>
                 <p class="count__amount">${cart.quantity}</p>
                <button class="count__plus" onclick="addingQuantity(${cart.id})">+</button>
            </div>
        </li>
    `).join('');
    }
    showBasket()
    totalPrice()
    document.getElementById('order_count').textContent = cartsInLocalStorage.length;
  }

  function addingQuantity(id) {
    let cartData = cartsInLocalStorage.find(item => item.id === id);
    cartData.quantity += 1;

    if (!cartsInLocalStorage.some(item => item.id === cartData.id)) {
      carts.push(cartData);
      localStorage.setItem('carts', JSON.stringify(carts));
    }

    totalPrice();
    getGoodsOfBasket();
  }

  function decreaseQuantity(id) {
    let cartData = cartsInLocalStorage.find(item => item.id === id);
    if (cartData.quantity > 1) {
      cartData.quantity -= 1;
    } else {
      carts = cartsInLocalStorage.filter(cart => cart.id !== cartData.id);
      localStorage.setItem('carts', JSON.stringify(carts));
      location.reload()
    }

    localStorage.setItem('carts', JSON.stringify(carts));

    getGoodsOfBasket();
    showBasket();
  }


  function showModalOrder() {
    document.getElementById('modal_order').classList.add('modal_open')
  }

  let eventTarget = ''

  function deliveryForm(event) {
    if (event === 'Самовывоз') {
     eventTarget = event
     document.getElementById('delivery_address').setAttribute('style', 'display: none')
     carts.isDelivery = false
     return localStorage.setItem('carts', JSON.stringify(carts))
    }
    eventTarget = event
    document.getElementById('delivery_address').setAttribute('style', 'display: flex')
    carts.isDelivery = true
    return localStorage.setItem('carts', JSON.stringify(carts))
  }

  function validateOrderForm() {
    let isValid = true

    const formDeliveryName = document.getElementById('form_delivery_name')
    const formDeliveryPhone = document.getElementById('form_delivery_phone')
    formDeliveryName.removeAttribute('style')
    formDeliveryPhone.removeAttribute('style')

    if (formDeliveryName.value.length < 3) {
       formDeliveryName.setAttribute('style', 'outline: 1px solid red')
       isValid = false
    }
    if (formDeliveryPhone.value.length < 3) {
       formDeliveryPhone.setAttribute('style', 'outline: 1px solid red')
      isValid = false
    }

   if(eventTarget !== 'Самовывоз') {
     const formDeliveryAddress = document.getElementById('form_delivery_address')
     formDeliveryAddress.removeAttribute('style')

     if (formDeliveryAddress.value.length < 3) {
       formDeliveryAddress.setAttribute('style', 'outline: 1px solid red')
       isValid = false
     }
   }

   return isValid;

  }

  async function makeOrder() {
    if (!validateOrderForm()) return

    const formDeliveryName = document.getElementById('form_delivery_name').value
    const formDeliveryPhone = document.getElementById('form_delivery_phone').value
    const formDeliveryAddress = document.getElementById('form_delivery_address').value


    const product = cartsInLocalStorage.map(item => ({
      id: item.name,
      count: Number(item.quantity),
      price: Number(item.price),
    }))

    const body = {
      product: product,
      totalPrice: cartsInLocalStorage.totalPrice,
      isDelivery: cartsInLocalStorage.isDelivery || true,
      name: formDeliveryName || '',
      phone: formDeliveryPhone || '',
      address: formDeliveryAddress || ''
    }

    try {
      const response = await fetch('/order', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(body),
      });

      await response.json();

      localStorage.removeItem('carts')
      location.reload()
    } catch (error) {
      console.error(error);
    }
  }

 async function filteredGoods(param) {
    const response = await fetch('/filter', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
      body: JSON.stringify(param),
    });

   console.log(await response.json());

  }


</script>
</body>
</html>


