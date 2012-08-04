<div class="product-full">
  <form id="product-form" action="/buy" method="post">
    <input type="hidden" name="id" value="{ID}" />
    <div class="breadcrunbs">
      <a href="/catalog/{CATALOG_ID}">{CATALOG}</a>
    </div>      
    <h1>{TITLE}</h1>      
    <div class="field field-image">
      <img src="/images/{ID}/image.jpg" alt="{TITLE} {DESC}" />
    </div>
    <div class="field field-sku">
      <div class="label">Код продукта: </div>
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
  </form>  
</div>
<script src="/js/product.js"></script>  