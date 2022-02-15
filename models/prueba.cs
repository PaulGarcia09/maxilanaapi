        <StackLayout Spacing="0" Margin="0">
                 <Grid RowDefinitions="Auto,Auto,Auto,*,Auto,Auto"
                       ColumnDefinitions="*,Auto" VerticalOptions="StartAndExpand" Padding="30,0,30,15">

                      <!-- 4. Popular-->
                <Label Grid.Column="0" Grid.Row="0" Text="Esclavas"
                       TextColor="#858788" FontSize="20" FontAttributes="Bold" />
                <Label Grid.Column="1" Grid.Row="0" Text="Ver todo"
                       HorizontalTextAlignment="End" FontAttributes="Bold" TextColor="Silver" VerticalTextAlignment="Center"/>
                 
                <CollectionView Grid.ColumnSpan="2" Grid.Row="1" HorizontalScrollBarVisibility="Never"
                                 x:Name="Esclavas"
                                 Margin="-20,0,-25,0"
                                 ItemsLayout="HorizontalList"
                                 HeightRequest="250">
                                 <CollectionView.ItemTemplate> 
                                   <DataTemplate>
                                        <StackLayout Padding="2,10,20,20">
                                           <Frame Padding="0,0,0,10" WidthRequest="200" HeightRequest="400" VerticalOptions="FillAndExpand" CornerRadius="15" HorizontalOptions="Start" HasShadow="False" >
                                               <Grid RowDefinitions="140,45,Auto" ColumnDefinitions="*,Auto">
                                                    <Frame Grid.ColumnSpan="2" Grid.Row="0" IsClippedToBounds="True" CornerRadius="25" HasShadow="False" Padding="0" >
                                                     <Image Source="{Binding imagen}" WidthRequest="200" HeightRequest="300" Aspect="AspectFit" />
                                                    </Frame>
                                                   <Label Grid.Column="0" Grid.Row="1"
                                                          Text="{Binding nombre}"
                                                          WidthRequest="100"
                                                          TextColor="#929292"
                                                          Margin="10,0,0,0">
                                                        <Label.FontSize>
                                                    <OnPlatform x:TypeArguments="x:Double" iOS="13" Android="10"/>
                                                    </Label.FontSize>
                                                   </Label>
                                                   <Label Grid.Column="0"
                                                          Padding="0"
                                                          Margin="15,0,0,0"
                                                          Grid.Row="2" Text="{Binding precioneto}"
                                                          TextColor="#0078b4" FontAttributes="Bold">
                                                       <Label.FontSize>
                                                    <OnPlatform x:TypeArguments="x:Double" iOS="14" Android="11"/>
                                                    </Label.FontSize>
                                                   </Label>
                                  
                                                   
                                               </Grid>
                                           </Frame>
                                       </StackLayout>
                                    </DataTemplate>
                                 </CollectionView.ItemTemplate>
                 </CollectionView>
                     </Grid>
               </StackLayout>
                      <StackLayout Spacing="0" Margin="0">
                 <Grid RowDefinitions="Auto,Auto,Auto,*,Auto,Auto"
                       ColumnDefinitions="*,Auto" VerticalOptions="StartAndExpand" Padding="30,0,30,15">

                      <!-- 4. Popular-->
                <Label Grid.Column="0" Grid.Row="0" Text="Cadenas"
                       TextColor="#858788" FontSize="20" FontAttributes="Bold" />
                <Label Grid.Column="1" Grid.Row="0" Text="Ver todo"
                       HorizontalTextAlignment="End" FontAttributes="Bold" TextColor="Silver" VerticalTextAlignment="Center"/>
                 
                <CollectionView Grid.ColumnSpan="2" Grid.Row="1" HorizontalScrollBarVisibility="Never"
                                 x:Name="Cadenas"
                                 Margin="-20,0,-25,0"
                                 ItemsLayout="HorizontalList"
                                 HeightRequest="250">
                                 <CollectionView.ItemTemplate> 
                                   <DataTemplate>
                                        <StackLayout Padding="2,10,20,20">
                                           <Frame Padding="0,0,0,10" WidthRequest="200" HeightRequest="400" VerticalOptions="FillAndExpand" CornerRadius="15" HorizontalOptions="Start" HasShadow="False" >
                                               <Grid RowDefinitions="140,45,Auto" ColumnDefinitions="*,Auto">
                                                    <Frame Grid.ColumnSpan="2" Grid.Row="0" IsClippedToBounds="True" CornerRadius="25" HasShadow="False" Padding="0" >
                                                     <Image Source="{Binding imagen}" WidthRequest="200" HeightRequest="300" Aspect="AspectFit" />
                                                    </Frame>
                                                   <Label Grid.Column="0" Grid.Row="1"
                                                          Text="{Binding nombre}"
                                                          WidthRequest="100"
                                                          TextColor="#929292"
                                                          Margin="10,0,0,0">
                                                        <Label.FontSize>
                                                    <OnPlatform x:TypeArguments="x:Double" iOS="13" Android="10"/>
                                                    </Label.FontSize>
                                                   </Label>
                                                   <Label Grid.Column="0"
                                                          Padding="0"
                                                          Margin="15,0,0,0"
                                                          Grid.Row="2" Text="{Binding precioneto}"
                                                          TextColor="#0078b4" FontAttributes="Bold">
                                                       <Label.FontSize>
                                                    <OnPlatform x:TypeArguments="x:Double" iOS="14" Android="11"/>
                                                    </Label.FontSize>
                                                   </Label>
                                  
                                                   
                                               </Grid>
                                           </Frame>
                                       </StackLayout>
                                    </DataTemplate>
                                 </CollectionView.ItemTemplate>
                 </CollectionView>
                     </Grid>
               </StackLayout>