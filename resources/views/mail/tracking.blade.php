หนังสือ : {!! $meta['book_name'] !!} <br>
เลข Order : Order #{!! $meta['ecwid_order_id'] !!} <br>
วันที่จัดส่ง : {!! $meta['date_of_shipping'] !!} <br>
จำนวน : {!! $meta['box_amount'] !!} กล่อง <br>
จัดส่งโดย : {!! $meta['transporter'] !!} <br>
ประเภทการจัดส่ง : {!! $meta['shipping_type'] !!} <br>
หมายเลขพัสดุ : {!! $meta['tracking_number'] !!} <br>
@if(isset($meta['remark']))
    หมายเหตุ : {!! $meta['remark'] !!} <br>
@endif
ตรวจสอบการจัดส่ง : {!! $meta['check_link'] !!} <br>
