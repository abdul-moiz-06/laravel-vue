import $ from 'jquery';
const base_url = $('meta[name=base_url]').attr('content');
const api_url = base_url + '/api';
const v1_url = api_url + '/v1';

export default {
  api_url: api_url,
  v1_url: v1_url
};
