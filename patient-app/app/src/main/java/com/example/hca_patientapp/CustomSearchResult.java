package com.example.hca_patientapp;

import android.app.Activity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

public class CustomSearchResult extends ArrayAdapter {
    private String[] name;
    private String[] desc;
    private String[] status;
    private Activity context;
    private String type;

    public CustomSearchResult(Activity context, String[] name, String[] desc, String[] status,String type) {
        super(context, R.layout.list_row, name);
        this.context = context;
        this.name = name;
        this.desc = desc;
        this.status = status;
        this.type = type;
    }

    @Override
    public View getView(int position, View view, ViewGroup parent) {
        LayoutInflater inflater = context.getLayoutInflater();
        View rowView= inflater.inflate(R.layout.list_row, null, true);
        TextView txtTitle = (TextView) rowView.findViewById(R.id.title);
        TextView txtDesc = (TextView) rowView.findViewById(R.id.desc);
        ImageView img = (ImageView)rowView.findViewById(R.id.list_image);
        if (type.equalsIgnoreCase("search")) {
            img.setImageResource(R.drawable.ic_doctor);
        }
        else if(type.equalsIgnoreCase("scheme")) {
            img.setImageResource(R.drawable.ic_link);
        }
        else if(type.equalsIgnoreCase("appointment")) {
            if (status[position].equalsIgnoreCase("Pending"))
            {
                img.setImageResource(R.drawable.ic_pending);
            }
            else if (status[position].equalsIgnoreCase("Accepted"))
            {
                img.setImageResource(R.drawable.ic_approved);
            }
            else if (status[position].equalsIgnoreCase("Rejected"))
            {
                img.setImageResource(R.drawable.ic_rejected);
            }
        }
        else
        {
            img.setImageResource(R.drawable.logo);
        }
        txtTitle.setText(name[position]);
        if (type.equalsIgnoreCase("scheme")) {
            txtDesc.setText(desc[position]);
        }
        else if(type.equalsIgnoreCase("search")) {
            txtDesc.setText(desc[position]);
        }
        else {
            txtDesc.setText(desc[position] + "\n\nStatus: " + status[position]);
        }
        return rowView;
    }

}
