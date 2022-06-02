import java.sql.*;
import java.util.*;
import java.io.*;

public class Seller extends end_user
{
    Connection c = null;

    public Seller()
    {
        id = "";
        username = "";
        password = "";
        location = "";
        amount = 0;
    }

    public void login(String username, String password)
    {
        try{
            c = DriverManager.getConnection("jdbc:postgresql://localhost:5432/TokoApp","postgres", "password");
            String sf = "SELECT * FROM public.seller WHERE users = ? AND pass = ?";
            PreparedStatement stmt = c.prepareStatement(sf);
            stmt.setObject(1, username);
            stmt.setObject(2, password);
            ResultSet rs = stmt.executeQuery();
            while(rs.next())
            {
                this.id = rs.getString("id_seller");
                this.location = rs.getString("lokasi");
                this.amount = rs.getDouble("amount");
                this.username = rs.getString("users");
                this.password = rs.getString("pass");
            }
        } catch(SQLException e) {
            System.out.println("User not found!\n");
            System.out.println(e.getMessage());
        }
    }

    public void sign_up(String id, String username, String password, String location, double amount)
    {
        this.id = id;
        this.username = username;
        this.password = password;
        this.location = location;
        this.amount = amount;

        try{
            c = DriverManager.getConnection("jdbc:postgresql://localhost:5432/TokoApp","postgres", "password");
            String sf = "INSERT INTO public.seller(id_seller, lokasi, amount, users, pass) VALUES(?,?,?,?,?)";
            PreparedStatement stmt = c.prepareStatement(sf);
            stmt.setObject(1, this.id);    
            stmt.setObject(2, this.location);
            stmt.setObject(3, this.amount);
            stmt.setObject(4, this.username);
            stmt.setObject(5, this.password);
            stmt.execute();
            c.close();
            System.out.println("Data Saved Succesfully!");
            System.out.println("Choose 0 to Login!\n");
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
    }

    public String get_username()
    {
        return this.username;
    }

    public double get_amount()
    {
        return this.amount;
    }

    public void add_item(String item_name, double price, int count)
    {
        try{
            c = DriverManager.getConnection("jdbc:postgresql://localhost:5432/TokoApp","postgres", "password");
            Item it = new Item();
            String id_item = UUID.randomUUID().toString();

            it.set_item(id_item, item_name, price, count);
            
            String sf = "INSERT INTO public.item(id_item, item_name, price, id_seller, count) VALUES(?,?,?,?,?)";
            PreparedStatement stmt = c.prepareStatement(sf);
            stmt.setObject(1, id_item);
            stmt.setObject(2, item_name);
            stmt.setObject(3, price);
            stmt.setObject(4, this.id);
            stmt.setObject(5, count);
            stmt.execute();
            c.close();
        } catch(SQLException e){
            System.out.println(e.getMessage());
        }
    }
    public void show_item()
    {
        try{
            c = DriverManager.getConnection("jdbc:postgresql://localhost:5432/TokoApp","postgres", "password");
            String sf = "SELECT * FROM public.item WHERE id_seller = ?";
            PreparedStatement stmt = c.prepareStatement(sf);
            stmt.setObject(1, this.id);
            ResultSet rs = stmt.executeQuery();
            
            ArrayList<Item> item_sold = new ArrayList<Item>();
            int length = 0;
            while(rs.next())
            {
                Item it = new Item();
                it.set_item(rs.getString("id_item"), rs.getString("item_name"), rs.getDouble("price"), rs.getInt("count"));
                item_sold.add(it);
                if(rs.getString("item_name").length() > length)
                {
                    length = rs.getString("id_item").length();
                }
            }
            String leftAlignFormat = "| %-35s | %-32.2f | %23d | %n";
            System.out.format("+-------------------------------------+----------------------------------+-------------------------+%n");
            System.out.format("|               ITEM NAME             |              PRICE               |            COUNT        |%n");
            System.out.format("+-------------------------------------+----------------------------------+-------------------------+%n");
            for (int i = 0; i < item_sold.size(); i++) 
            {
                System.out.format(leftAlignFormat, item_sold.get(i).get_item_name(), item_sold.get(i).get_price(), 
                item_sold.get(i).get_count());
            }
            System.out.format("+-------------------------------------+----------------------------------+-------------------------+%n");
            c.close();
        } catch(SQLException e){
            System.out.println(e.getMessage());
        }
    }
    public void delete_item(String item_name)
    {
        try{
            c = DriverManager.getConnection("jdbc:postgresql://localhost:5432/TokoApp","postgres", "password");
            String sf = "DELETE FROM public.item WHERE id_seller = ? AND item_name = ?";
            PreparedStatement stmt = c.prepareStatement(sf);
            stmt.setObject(1, this.id);
            stmt.setObject(2, item_name);
            stmt.execute();
            c.close();
        } catch(SQLException e){
            System.out.println(e.getMessage());
        }
    }
    public void selling_history()
    {

    }
    public void transfer_amount()
    {

    }

    public void clrscr()
    {
        //Clears Screen in java
        try {
            if (System.getProperty("os.name").contains("Windows"))
                new ProcessBuilder("cmd", "/c", "cls").inheritIO().start().waitFor();
            else
                Runtime.getRuntime().exec("clear");
        } catch (IOException | InterruptedException ex) {
            
        }
    }
}