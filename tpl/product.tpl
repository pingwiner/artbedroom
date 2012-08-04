<div class="product-full">
  <form id="product-form">
    <input type="hidden" id="product-id" name="id" value="{ID}" />
    <div class="breadcrunbs">
      &rarr; Каталог: <a href="/catalog/{CATALOG_ID}">{CATALOG}</a>
    </div>      
    <h1>{TITLE}</h1>      
    
    <div class="cool-box">
      <div class="floating-box product-img">
        <div class="field field-image">
          <img src="/images/{ID}/image.jpg" alt="{TITLE} {DESC}" />
        </div>
      </div>
      
      <div class="floating-box product-params">
        
        <div class="field field-sku">
          <div class="label">Код товара: </div>
          <div class="value">{SKU}</div>
        </div>  
        <div class="field field-color">
          <div class="label">Цвет: </div>
          <div class="value">
            <select id="color" name="color">
              {COLOR_OPTIONS}
            </select>
          </div>
        </div>      
        <div class="field field-size">
          <div class="label">Размер: </div>
          <div class="value">
            <select id="size" name="size">
              {SIZE_OPTIONS}
            </select>
          </div>
        </div>  
        <div class="field field-material">
          <div class="label">Материал: </div>
          <div class="value">{MATERIAL}</div>
        </div>          
        <div class="field field-description">
          <div class="label">Описание: </div>
          <div class="value">{DESCRIPTION}</div>
        </div>  
        <div class="field field-price">
          <div class="label">Цена: </div>
          <div class="value">{PRICE}</div>
        </div>
        <div class="cart">
          <a class="btn btn-primary" id="buy" data-toggle="modal" href="#myModal"><i class="icon-shopping-cart"></i>Купить</a>
        </div>  
      </div>  
    </div>  
      
  </form>  
</div>
<div class="modal hide fade" id="myModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Оформление заказа</h3>
  </div>
  <div class="modal-body">
    <p>
      <form class="form-horizontal" action="/buy">
        <fieldset>
          <div class="field">
            <label class="control-label" for="phone">Телефон</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="phone" name="phone">
            </div>
          </div>  
          <div class="field">
            <label class="control-label" for="phone">Имя</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="username" name="username">
            </div>           
          </div>
          <div class="field">
            <label class="control-label" for="message">Примечание</label>
            <div class="controls">
              <textarea id="message" name="message" class="input-xlarge" rows="3"></textarea>
            </div>
          </div>  
      </form>        
    </p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Отмена</a>
    <a href="#" id="submit-order" class="btn btn-primary">Отправить</a>
  </div>
</div>
<div class="modal hide fade" id="modalOk">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Ваш заказ принят</h3>
  </div>
  <div class="modal-body">
    <p>
      В ближайшее время мы свяжемся с Вами для уточнения времени доставки.
    </p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn btn-primary" data-dismiss="modal">Ok</a>
  </div>
</div>        
<script src="/js/product.js"></script>  