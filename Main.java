import java.util.*;

public class Main
{
    public static void main(String args[])
    {
        System.out.println("\nWELCOME TO TOKOAPP");
        System.out.println("-------------------------------------");
        System.out.println("-------------------------------------\n");

        Scanner inp = new Scanner(System.in);

        int seller_ind = 0;
        int buyer_ind = 0;

        Seller seller = new Seller();

        //login signup
        while(true)
        {
            System.out.println("If you are a buyer press 0");
            System.out.println("If you are a seller press 1");
            System.out.printf("Choice : ");

            int choice = inp.nextInt();

            if(choice == 0)
            {
                System.out.println("\nChoose 0 for Login");
                System.out.println("Choose 1 for Sign Up");
                
                System.out.printf("Choice : ");
                int c = inp.nextInt();

                if(c == 0)
                {
                    System.out.println("\n");
                    
                }
                else
                {

                }
            }
            else if(choice == 1)
            {   
                while(true)
                {
                    System.out.println("\nChoose 0 for Login");
                    System.out.println("Choose 1 for Sign Up");
                    System.out.println("Choose 2 for Back");
                    
                    System.out.printf("Choice : ");
                    int c = inp.nextInt();

                    if(c == 0)
                    {
                        System.out.println("\n");
                        String dummy = inp.nextLine();
                        System.out.printf("Username : ");
                        String username = inp.nextLine();
                        System.out.printf("Password : ");
                        String password = inp.nextLine();
                        seller.login(username, password);
                        seller_ind = 1;
                        break;
                    }
                    else if(c == 1)
                    {
                        String uniqueID = UUID.randomUUID().toString();
                        System.out.printf("Username : ");
                        String dummy = inp.nextLine();
                        String username = inp.nextLine();
                        System.out.printf("Password : ");
                        String password = inp.nextLine();
                        System.out.printf("Location : ");
                        String location = inp.nextLine();
                        seller.sign_up(uniqueID, username, password, location, 0);
                    }
                    else if(c == 2)
                    {
                        break;
                    }
                    else
                    {
                        System.out.println("Invalid Input!\n");
                    }
                }
            }
            else
            {
                System.out.println("Invalid Input!");
                System.out.println("Please Choose 0 or 1!\n");
            }

            if(seller_ind == 1 || buyer_ind == 1)
            {
                break;
            }
        }

        //after login
        if(seller_ind == 1)
        {
            while(true)
            {
                System.out.printf("===========Welcome to TokoApp, %s!===========\n\n", seller.get_username());
                System.out.printf("Amount : %.2f\n", seller.get_amount());
                System.out.printf("\nItem for Sale:\n");

                System.out.println("\nPress:");
                System.out.println("1) Add Item");
                System.out.println("2) Delete Item");
                    
                System.out.printf("\nChoice : ");
                int choice = inp.nextInt();
                String dummy = inp.nextLine();

                if(choice == 1)
                {
                    System.out.println("\n=========ADD ITEM===========");
                    System.out.printf("Item Name : ");
                    String item_name = inp.nextLine();
                    System.out.printf("Price : ");
                    double price = inp.nextInt();
                    System.out.printf("Count : ");
                    int count = inp.nextInt();
                    seller.add_item(item_name, price, count);
                    System.out.println("Item Added Successfully!");
                }
                else if(choice == 2)
                {
                    System.out.println("\n=========DELETE ITEM===========");
                    System.out.printf("Item Name : ");
                    String item_name = inp.nextLine();
                    System.out.printf("Delete %s?\n", item_name);
                    System.out.println("Press:");
                    System.out.println("1) Yes");
                    System.out.println("2) No");

                    int c = inp.nextInt();
                    if(c == 1)
                    {
                        seller.delete_item(item_name);
                        System.out.println("Item deleted successfully!");
                    }
                    else if(c == 2)
                    {
                        
                    }
                }
            }
        }
        else if(buyer_ind == 1)
        {

        }

    }
}