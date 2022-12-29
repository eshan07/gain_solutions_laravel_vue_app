## Product API
1. Store Product: {POST} https://laravel-vue.eshandev.com/api/v1/admin/products 
#### key:values
```
{
category_id:1,
name:Table tenisa,
description:Bangladesh is game of table tenins where nothing is impossiblew!,
specification:Bangladesh is game of table tenins where nothing is impossiblew!,
delivery_info:Bangladesh is game of table tenins where nothing is impossiblew!,
faqs:Bangladesh is game of table tenins where nothing is impossiblew!,
short_note:Bangladesh is game of table tenins where nothing is impossiblew!,
current_stock:10,
price:250,
unit:pcs,
feature_image:{},
images[]:[{},{}]
}
```
2. List Product: {GET} https://laravel-vue.eshandev.com/api/v1/admin/products 
3. Update Product: {PUT} https://laravel-vue.eshandev.com/api/v1/admin/products/{product_slug}
#### key:values
```
{
category_id:1,
name:Table tenisa,
description:Bangladesh is game of table tenins where nothing is impossiblew!,
specification:Bangladesh is game of table tenins where nothing is impossiblew!,
delivery_info:Bangladesh is game of table tenins where nothing is impossiblew!,
faqs:Bangladesh is game of table tenins where nothing is impossiblew!,
short_note:Bangladesh is game of table tenins where nothing is impossiblew!,
current_stock:10,
price:250,
unit:pcs,
feature_image:{},
images[]:[{},{}]
}
```
4. Delete Product : {DELETE} https://laravel-vue.eshandev.com/api/v1/admin/products/{product_slug}
