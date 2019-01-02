<div class="panel sachmoi panel-default">
    <div class="panel-heading">
        <h4 class="titlesachmoi"><i class="glyphicon glyphicon-bookmark"></i>
            Sách mới
            <?php echo $this->Html->link('(xem tất cả →)', '/sach-moi' , array('class'=> 'more'))?>  
        </h4>
    </div>
    <div class="row">
        <?php echo $this->element('books')?>
    </div>
    <div class="panel-body">
        
    </div>
</div><!-- end panel -->



<div class="panel sachchay panel-default">
  <div class="panel-heading">
        <h4 class="titlesachchay"><i class="glyphicon glyphicon-fire"></i> Sách bán chạy<a href="/sach-ban-chay" class="more">(xem tất cả →)</a>                
        </h4>
  </div>
  <div class="panel-body">
       <div class="row">
          <div class="col col-md-3 motsp">
             <a href=""><img src="img/harry-potter-7.jpg" height="200" width="140" alt="ảnh1"></a>
             <p><a href="">Ngày xưa có một con bò</a></p>
            <p><a href="" class="author">Camilo Cruz</a></p>                       
            <p class="price">Giá: 20,000 VND</p>
          </div><!-- end col 3 -->
           <div class="col col-md-3 motsp">
             <a href=""><img src="img/ngay-xua-co-mot-con-bo.jpg" height="200" width="140" alt="ảnh1"></a>
             <p><a href="">Ngày xưa có một con bò</a></p>
            <p><a href="" class="author">Camilo Cruz</a></p>                       
            <p class="price">Giá: 20,000 VND</p>
          </div><!-- end col 3 -->
           <div class="col col-md-3 motsp">
             <a href=""><img src="img/suc-manh-cua-so-6.jpg" height="200" width="140" alt="ảnh1"></a>
             <p><a href="">Ngày xưa có một con bò</a></p>
            <p><a href="" class="author">Camilo Cruz</a></p>                       
            <p class="price">Giá: 20,000 VND</p>
          </div><!-- end col 3 -->
           <div class="col col-md-3 motsp">
             <a href=""><img src="img/tac-nhan-thu-hut.jpg" height="200" width="140" alt="ảnh1"></a>
             <p><a href="">Ngày xưa có một con bò</a></p>
            <p><a href="" class="author">Camilo Cruz</a></p>                       
            <p class="price">Giá: 20,000 VND</p>
          </div><!-- end col 3 -->
         
      </div><!-- end row nho -->
  </div>
</div><!-- end panel -->