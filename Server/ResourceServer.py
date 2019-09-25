import string
import random
import os
import flask
import requests

def client_register(client_name, redirect_url):
    return flask.redirect('localhost/client_register.php')

def client_checkInfo(client_data):
    response = requests.post("http://localhost/client_checkInfo.php", data=client_data)
    return response.text

def fetch_token(client_data, uid):
	client_data['uid'] = uid
	response = requests.post("http://localhost/fetch_token.php", data=client_data)
	return response.text

def get_data(client_data):
	response = requests.post("http://localhost/get_data.php", data=client_data)
	print(client_data)
	return response.text
