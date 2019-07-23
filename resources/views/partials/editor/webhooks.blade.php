<div class="hidden clonable accordion-webhooks">
  <div class='accordion-section webhooks'>
    <div class='accordion-header'>Webhooks</div>

    <div class='accordion' style='display:none'>
      <select class="webhookSelect form-control" onchange="javascript:webhookSelect(this)">
        <option>No Webhooks</option>
        <option>Use a Webhook</option>
      </select>

      <div class="webhookEditor" style="display:none">
        <div>
          <label class="control-label" save_image_to_download="true">Post Field Values</label>
          <i data-toggle="tooltip" title="" data-original-title="Add another field and value to the POST" class="fas fa-plus-circle" onclick="javascript:addWebhook()"></i>
        </div>

        <select data-toggle="tooltip" title="" data-original-title="Select the variables that will be posted to the endpoint by id = value" class="allIds webhookId form-control"></select>

        <div data-toggle="tooltip" title="" data-original-title="The URL endpoint that will be called in the POST">
          <label class="control-label" save_image_to_download="true">Endpoint URL</label>
        </div>

        <input type="text" class="form-control webhookEndpoint" />

        <div data-toggle="tooltip" title="" data-original-title="The data format that will be transmitted and will also dictate the expected format for the response">
          <label class="control-label" save_image_to_download="true">Data Format</label>
        </div>

        <select class="webhookMethod">
          <option>json</option>
          <option>xml</option>
          <option>html</option>
          <option>script</option>
          <option>jsonp</option>
          <option>text</option>
        </select>

        <div data-toggle="tooltip" title="" data-original-title="The data index or path to retrieve from the response object, slashes / can be used for traversing hierarchies">
            <label class="control-label" save_image_to_download="true">Response Index/Path</label>
        </div>

        <input type="text" class="form-control webhookResponseIndex" />

        <div data-toggle="tooltip" title="" data-original-title="The data response that is received. A single value option or an array of options">
            <label class="control-label" save_image_to_download="true">Response Type</label>
        </div>

        <select class="webhookOptionsArray" onchange="javascript:webhookOptions(this)">
          <option>Single Response</option>
          <option>Will Contain Many Options</option> <!--only valid if using checkbox, radio or select-->
        </select>

        <div class="webhookOptionsEditor" style="display:none">
          <div data-toggle="tooltip" title="" data-original-title="When parsing an array of options to populate your question field, is it from a delimited string or data constructed as siblings of a parent">
            <label class="control-label" save_image_to_download="true">Array Split Method</label>
          </div>

          <select class="webhookResponseOptionType" onchange="javascript:webhookResponseOptionType(this)">
            <option>Select</option>
            <option>Delimiter</option>
            <option>Index/Path</option>
          </select>

          <input type="text" class="form-control webhookDelimiter webhookResponseMethod" style="display:none" />
          <input type="text" class="form-control webhookIndex webhookResponseMethod" style="display:none" />
        </div>
      </div> {{-- /.webhookEditor --}}
    </div> {{-- /.accordion --}}
  </div> {{-- /.accordion-section --}}
</div>  {{-- /.accordion-webhooks --}}