package com.example.hca_patientapp;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class ChatActivity extends AppCompatActivity {

    ListView listView;

    ProgressDialog pDialog;

    JSONArray jsonArray = null;

    String retCnt;
    String retVal;
    // creating variables for our
    // widgets in xml file.
    RecyclerView chatsRV;
    ImageButton sendMsgIB;
    EditText userMsgEdt;
    private final String USER_KEY = "user";
    private final String BOT_KEY = "bot";

    // creating a variable for
    // our volley request queue.
    private RequestQueue mRequestQueue;

    // creating a variable for array list and adapter class.
    private ArrayList<MessageModal> messageModalArrayList;
    private MessageRVAdapter messageRVAdapter;

    String uMsg;
    int cnt=0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_chat);

        getSupportActionBar().setTitle("Chat Bot");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        // on below line we are initializing all our views.
        chatsRV = (RecyclerView) findViewById(R.id.idRVChats);
        sendMsgIB = (ImageButton) findViewById(R.id.idIBSend);
        userMsgEdt = (EditText) findViewById(R.id.idEdtMessage);

        // below line is to initialize our request queue.
        mRequestQueue = Volley.newRequestQueue(ChatActivity.this);
        mRequestQueue.getCache().clear();

        // creating a new array list
        messageModalArrayList = new ArrayList<>();

        // adding on click listener for send message button.
        sendMsgIB.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // checking if the message entered
                // by user is empty or not.
                if (userMsgEdt.getText().toString().isEmpty()) {
                    // if the edit text is empty display a toast message.
                    Toast.makeText(ChatActivity.this, "Please enter your message..", Toast.LENGTH_SHORT).show();
                    return;
                }

                // calling a method to send message
                // to our bot to get response.
                sendMessage(userMsgEdt.getText().toString());

                // below line we are setting text in our edit text as empty
                userMsgEdt.setText("");
            }
        });

        // on below line we are initialing our adapter class and passing our array list to it.
        messageRVAdapter = new MessageRVAdapter(messageModalArrayList, this);

        // below line we are creating a variable for our linear layout manager.
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(ChatActivity.this, RecyclerView.VERTICAL, false);

        // below line is to set layout
        // manager to our recycler view.
        chatsRV.setLayoutManager(linearLayoutManager);

        // below line we are setting
        // adapter to our recycler view.
        chatsRV.setAdapter(messageRVAdapter);

        messageModalArrayList.add(new MessageModal("Hi, welcome to HealthHeal ChatBot, what symptoms are you facing today?", BOT_KEY));

        // notifying our adapter as data changed.
        messageRVAdapter.notifyDataSetChanged();
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() == android.R.id.home) {
            finish();
        }
        return super.onOptionsItemSelected(item);
    }

    private void sendMessage(String userMsg)
    {
        messageModalArrayList.add(new MessageModal(userMsg, USER_KEY));
        messageRVAdapter.notifyDataSetChanged();
        uMsg = userMsg;
        //messageModalArrayList.add(new MessageModal("botResponse", BOT_KEY));
        new getResponse().execute();
    }

    class getResponse extends AsyncTask<String,String,String> {
        protected void onPreExecute(){
            super.onPreExecute();
            pDialog = new ProgressDialog(ChatActivity.this);
            pDialog.setMessage("Searching... Please wait...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }

        protected String doInBackground(String...args){
            List<NameValuePair> params= new ArrayList<NameValuePair>();
            String url_user_details =  Common.server_url + "appGetChatReponse.php";
            params.add(new BasicNameValuePair("term", uMsg));
            JSONParser jParser = new JSONParser();
            JSONObject json = jParser.makeHttpRequest(url_user_details, "POST", params);

            try {
                JSONArray cat=json.getJSONArray("response");
                for(int i=0;i<cat.length();i++){
                    JSONObject jsonObject=cat.getJSONObject(i);
                    retCnt=jsonObject.getString("count");
                    retVal=jsonObject.getString("value");
                }
            }catch (JSONException e){
                e.printStackTrace();
            }

            return null;
        }

        protected void onPostExecute(String file_url){

            if (Integer.parseInt(retCnt)>0)
            {
                messageModalArrayList.add(new MessageModal(retCnt + " results found for your query", BOT_KEY));
                messageModalArrayList.add(new MessageModal(retVal, BOT_KEY));
                cnt=0;
            }
            else
            {
                messageModalArrayList.add(new MessageModal("Sorry, I could not understand that, please refine your query", BOT_KEY));
                cnt++;
                if (cnt>=3)
                {
                    messageModalArrayList.add(new MessageModal("Wait, let me help you with list of disease", BOT_KEY));
                    cnt=0;
                    pDialog.dismiss();
                    new getDisease().execute();
                }
            }
            pDialog.dismiss();
        }
    }

    class getDisease extends AsyncTask<String,String,String> {
        protected void onPreExecute(){
            super.onPreExecute();
            pDialog = new ProgressDialog(ChatActivity.this);
            pDialog.setMessage("Loading... Please wait...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }

        protected String doInBackground(String...args){
            List<NameValuePair> params= new ArrayList<NameValuePair>();
            String url_user_details =  Common.server_url + "appGetDiseaseList.php";
            JSONParser jParser = new JSONParser();
            JSONObject json = jParser.makeHttpRequest(url_user_details, "POST", params);

            try {
                JSONArray cat=json.getJSONArray("response");
                for(int i=0;i<cat.length();i++){
                    JSONObject jsonObject=cat.getJSONObject(i);
                    retCnt=jsonObject.getString("count");
                    retVal=jsonObject.getString("value");
                }
            }catch (JSONException e){
                e.printStackTrace();
            }

            return null;
        }

        protected void onPostExecute(String file_url){

            messageModalArrayList.add(new MessageModal(retVal, BOT_KEY));
            cnt=0;
            pDialog.dismiss();
        }
    }

    /*private void sendMessage(String userMsg) {
        // below line is to pass message to our
        // array list which is entered by the user.
        messageModalArrayList.add(new MessageModal(userMsg, USER_KEY));
        messageRVAdapter.notifyDataSetChanged();

        // url for our brain
        // make sure to add mshape for uid.
        // make sure to add your url.
        String url = "http://api.brainshop.ai/get?bid=YOUR_BRAINSHOP_BID&key=YOUR_BRAINSHOP_KEY&uid=[uid]&msg=" + userMsg;

        // creating a variable for our request queue.
        RequestQueue queue = Volley.newRequestQueue(ChatActivity.this);

        // on below line we are making a json object request for a get request and passing our url .
        JsonObjectRequest jsonObjectRequest = new JsonObjectRequest(Request.Method.GET, url, null, new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                try {
                    // in on response method we are extracting data
                    // from json response and adding this response to our array list.
                    String botResponse = response.getString("cnt");
                    messageModalArrayList.add(new MessageModal(botResponse, BOT_KEY));

                    // notifying our adapter as data changed.
                    messageRVAdapter.notifyDataSetChanged();
                } catch (JSONException e) {
                    e.printStackTrace();

                    // handling error response from bot.
                    messageModalArrayList.add(new MessageModal("No response", BOT_KEY));
                    messageRVAdapter.notifyDataSetChanged();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                // error handling.
                messageModalArrayList.add(new MessageModal("Sorry no response found", BOT_KEY));
                Toast.makeText(ChatActivity.this, "No response from the bot..", Toast.LENGTH_SHORT).show();
            }
        });

        // at last adding json object
        // request to our queue.
        queue.add(jsonObjectRequest);
    }*/
}
