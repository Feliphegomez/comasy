<?php 
global $website;
$pages_list = new Pages();
?>
<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Publicadas</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Borradores</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Papelera</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Otras</a></li>
  </ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
        <div class="bs-example widget-shadow" data-example-id="hoverable-table">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titulo</th>
                        <th>Url</th>
                        <th>Estado</th>
                        <th>F. Creacion</th>
                        <th>E. Comentarios</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pages_list->list('publish') as $page){ ?>
                        <tr>
                            <td><?php echo $page->id; ?></td>
                            <td><a href="<?php echo $website->options->admin_path."page/?page_id={$page->id}"; ?>"><?php echo $page->title; ?></a></td>
                            <td><?php echo $page->get_url(); ?></td>
                            <td>
                                <?php echo $page->ping_status; ?>
                                <a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'ping_status', '<?php echo $page->ping_status; ?>');" class="btn btn-primary btn-sm">
                                    <i class="fa fa-exchange" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td><?php echo $page->date; ?></td>
                            <td>
                                <?php echo $page->comment_status; ?>
                                
                                <a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'comment_status', '<?php echo $page->comment_status; ?>');" class="btn btn-primary btn-sm">
                                    <i class="fa fa-exchange" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $website->options->admin_path."page/edit/?page_id={$page->id}"; ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
	                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
        <div class="bs-example widget-shadow" data-example-id="hoverable-table">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titulo</th>
                        <th>Url</th>
                        <th>Estado</th>
                        <th>F. Creacion</th>
                        <th>E. Comentarios</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pages_list->list('draft') as $page){ ?>
                        <tr>
                            <td><?php echo $page->id; ?></td>
                            <td><a href="<?php echo $website->options->admin_path."page/?page_id={$page->id}"; ?>"><?php echo $page->title; ?></a></td>
                            <td><?php echo $page->get_url(); ?></td>
                            <td>
                                <?php echo $page->ping_status; ?>
                                <a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'ping_status', '<?php echo $page->ping_status; ?>');" class="btn btn-primary btn-sm">
                                    <i class="fa fa-exchange" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td><?php echo $page->date; ?></td>
                            <td>
                                <?php echo $page->comment_status; ?>
                                
                                <a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'comment_status', '<?php echo $page->comment_status; ?>');" class="btn btn-primary btn-sm">
                                    <i class="fa fa-exchange" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $website->options->admin_path."page/edit/?page_id={$page->id}"; ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
	                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">
        <div class="bs-example widget-shadow" data-example-id="hoverable-table">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titulo</th>
                        <th>Url</th>
                        <th>Estado</th>
                        <th>F. Creacion</th>
                        <th>E. Comentarios</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pages_list->list('trash') as $page){ ?>
                        <tr>
                            <td><?php echo $page->id; ?></td>
                            <td><a href="<?php echo $website->options->admin_path."page/?page_id={$page->id}"; ?>"><?php echo $page->title; ?></a></td>
                            <td><?php echo $page->get_url(); ?></td>
                            <td>
                                <?php echo $page->ping_status; ?>
                                <a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'ping_status', '<?php echo $page->ping_status; ?>');" class="btn btn-primary btn-sm">
                                    <i class="fa fa-exchange" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td><?php echo $page->date; ?></td>
                            <td>
                                <?php echo $page->comment_status; ?>
                                
                                <a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'comment_status', '<?php echo $page->comment_status; ?>');" class="btn btn-primary btn-sm">
                                    <i class="fa fa-exchange" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $website->options->admin_path."page/edit/?page_id={$page->id}"; ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
	                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="settings">
        <div class="bs-example widget-shadow" data-example-id="hoverable-table">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titulo</th>
                        <th>Url</th>
                        <th>Estado</th>
                        <th>F. Creacion</th>
                        <th>E. Comentarios</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pages_list->list('other') as $page){ ?>
                        <tr>
                            <td><?php echo $page->id; ?></td>
                            <td><a href="<?php echo $website->options->admin_path."page/?page_id={$page->id}"; ?>"><?php echo $page->title; ?></a></td>
                            <td><?php echo $page->get_url(); ?></td>
                            <td>
                                <?php echo $page->ping_status; ?>
                                <a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'ping_status', '<?php echo $page->ping_status; ?>');" class="btn btn-primary btn-sm">
                                    <i class="fa fa-exchange" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td><?php echo $page->date; ?></td>
                            <td>
                                <?php echo $page->comment_status; ?>
                                
                                <a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'comment_status', '<?php echo $page->comment_status; ?>');" class="btn btn-primary btn-sm">
                                    <i class="fa fa-exchange" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $website->options->admin_path."page/edit/?page_id={$page->id}"; ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
	                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>

</div>


