<?php $this->load->view('backend/template/header'); ?>

<style>
	table#tbl-indicadores {
        display: block;
        overflow-x: auto;
        height: 400px;
    }
    #tbl-indicadores th, #tbl-indicadores td{
    	white-space: nowrap;
    }
</style>
  


<?php $this->load->view('backend/template/footer'); ?>
<script src="<?php echo base_url();?>resources/js/indicadores.js"></script>