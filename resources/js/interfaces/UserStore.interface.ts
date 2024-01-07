import { Favorites } from "./Favorites.interface";

export interface UserStore {
  user: User | undefined;
  usersList: User[];
}

export interface User {
  id: number;
  name: string;
  email: string;
  isAdmin: boolean;
  canLogin: boolean;
  favorites?: Favorites[];
}
