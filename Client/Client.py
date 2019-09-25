import flask
import ResourceServer
import requests

app = flask.Flask(__name__)

client_info = {'cid':'cid', 'passwd':'passwd', 'redirect_url':'http://192.168.56.1:5000/'}

user_accessed = []

@app.route('/', methods=["GET","POST"])
def index():
	if flask.request.method == "POST":
		client_info['auth_code'] = flask.request.form.get('auth_code')
		user_accessed.append(flask.request.form.get('uid'))
		return flask.render_template('use_data.html')
#		return ResourceServer.fetch_token(client_info, user_accessed[0])
	else:
	    return flask.render_template('login.html')

@app.route('/client_check', methods=["POST"])
def client_check():
    if flask.request.method == "POST":
        return ResourceServer.client_checkInfo(client_info)

@app.route('/fetch_token', methods=["POST"]) 
def fetch_token():
	if flask.request.method == "POST":
		return ResourceServer.fetch_token(client_info, user_accessed[0])

@app.route('/token_callback', methods=["POST"])
def token_callback():
	if flask.request.method == "POST":
		client_info['access_token'] = flask.request.form.get('access_token')
		return ResourceServer.get_data(client_info)
#if result == True:
    #    return flask.render_template(login_url)

if __name__ == "__main__":
    app.run(host='192.168.56.1',debug = True)

