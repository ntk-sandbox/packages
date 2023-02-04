define(['jquery'], function($) {

    var helper = {
        renderHeader: function (content) {
            var closeButtonHtml = '<button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">×</span></button>';
            var titleHeaderHtml = '<h4 class="modal-title">'+content+'</h4>';
            return '<div class="modal-header">'+closeButtonHtml+titleHeaderHtml+'</div>';
        },
        renderBody: function (content) {
            return  '<div class="modal-body">'+content+'</div>';
        },
        renderFooter: function (content) {
            return '<div class="modal-footer">'+content+'</div>';
        },
        renderModal: function (data) {
            var contentHtml = '';
            if(data.title) {
                contentHtml = contentHtml + helper.renderHeader(data.title);
            }
            if(data.body) {
                contentHtml = contentHtml + helper.renderBody(data.body);
            }
            if(data.foot) {
                contentHtml = contentHtml + helper.renderFooter(data.foot);
            }
            return '<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\n' +
                '        <div class="modal-dialog" role="document">\n' +
                '            <div class="modal-content">'+contentHtml+'</div>\n' +
                '        </div>\n' +
                '    </div>';
        },
    };

    return {
        show: function (data, options) {
            var modalHtml = helper.renderModal(data);
            var modalEl = $(modalHtml);
            var bodyWrapper = $('body');
            $('.modal').remove();
            bodyWrapper.append(modalEl);
            modalEl.modal();
        },
    };

});