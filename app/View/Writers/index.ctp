<div class="books index">
    <h2><?php echo __('Cac tac gia') ?></h2>
    <h4><?php echo $this->Paginator->sort('name', 'Sap Xep Theo Ten') ?></h4>
    <!-- <?php pr($writers)?> -->
    <?php foreach ($writers as $key => $writer): ?>
        <?php echo ($writer['Writer']['name']) ?><br/>
    <?php endforeach ?><br/>
    <?php echo $this->element('pagination'))?>
</div>